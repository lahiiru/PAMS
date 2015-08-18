
import java.util.logging.Level;
import java.util.logging.Logger;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 *
 * @author Lahiru
 */
public class Processor implements Runnable {
    
    Scheduler shortScheduler;                                                   // Short term scheduler instance
    MedScheduler medScheduler;                                                  // Medium term scheduler instance
    MainGUI gui;                                                                // GUI instance
    Process lastExecutedProcess;                                                // Last executed process by processor
    int cpuTime;                                                                // CPU time in clock pulses
    String restartReason="";                                                    // Reason for restarting
    int microStepsPerStep=20;                                                   // Clock cycles per unit time                                                   
    boolean restarting = false;
    boolean freezed = false;
    boolean halted = false;
    boolean unitStepOn=false;
    boolean stepRunning=false;
    
    public Processor(MainGUI g) {

        if(g.changeSize()>20){                                                  // Determine best value for mico steps
            microStepsPerStep=g.welcomeLabel.getWidth()/g.changeSize();
        }
        
        gui = g;
        shortScheduler = new Scheduler();
        medScheduler = new MedScheduler(this, shortScheduler);
        cpuTime = 0;

    }

    public void setRestart(String message) {                                    // Restart processor
        restarting = true;
        restartReason = message;
    }

    public String toggleFreeze() {                                              // Toggle freeze attribute, pause simulation
        freezed = !freezed;
        if (freezed) {
            return "Release";
        } else {
            return "Freeze";
        }
    }

    public void start() {                                                       // Start processor in separate thread
        new Thread(this).start();
    }
    private void maintainSpeed(int speed){                                      // Determine the necessary delay
            try {
                Thread.sleep((11 - speed) * 10);
            } catch (InterruptedException ex) {
                Logger.getLogger(Processor.class.getName()).log(Level.SEVERE, null, ex);
            }    
    }
    @Override
    public void run() {
        while (true) {                                                          // Execution cycle runs whenever processor tuns

            maintainSpeed(gui.getSpeed());
            
             if (restarting) {                                                  // If restarting exit from execution cycle
                gui.writeLog("Session ended. Restartig...! Reason:"+restartReason, cpuTime);
                restarting = false;
                return;
            }           
            
            if(unitStepOn && !stepRunning){                                     // If unit step pause is there, skip
                continue;
                
            }
            
            if (freezed&&!unitStepOn) {                                         // If freezed skip
                continue;
            }

            medScheduler.execute(cpuTime);                                      // Execute medium term scheduler once
            
            gui.updateActiveProcesses(shortScheduler.getActiveProcesses());     // Update GUI lables
            
            if (shortScheduler.getActiveProcess() != null) {                    // If process found to execute
                halted = false;
                Process pr = shortScheduler.getActiveProcess();                 // Ask short term scheduler to get a process
                pr.execute();
                lastExecutedProcess = pr;
            } else {                                                            // If no process available in short term scheduler
                if (medScheduler.isHalted()) {                                  // If no processes available in medium term scheduler
                    gui.writeLog("System halted! ", cpuTime);
                    return; //processes over
                } else {                                                        // If processes are available in medium term scheduler to come in future
                    if (!halted) {                                              
                        gui.writeLog("Processor halted! Waiting for medium term scheduler...", cpuTime);
                        halted = true;
                    }
                }
            }

            cpuTime++;                                                          // Increase to next execution cycle
            if(cpuTime%microStepsPerStep==0)stepRunning=false;                  // If edge of a step found
            gui.jTextField12.setText(cpuTime / microStepsPerStep + " : " + cpuTime % microStepsPerStep);

        }
    }

}
