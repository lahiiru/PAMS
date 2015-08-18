
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

    Scheduler sch;
    MedScheduler medsch;
    MainGUI gui;
    Process lastExecProcess;
    int cpuTime;
    boolean restart = false;
    boolean freezed = false;
    boolean procHalted = false;
    boolean unitStep=false;
    boolean stepRunning=false;
    
    public Processor(MainGUI g) {
        gui = g;
        sch = new Scheduler();
        medsch = new MedScheduler(this, sch);
        cpuTime = 0;
    }

    public void setRestart() {
        restart = true;
    }

    public String toggleFreeze() {
        freezed = !freezed;
        if (freezed) {
            return "Release";
        } else {
            return "Freeze";
        }
    }

    public void start() {
        new Thread(this).start();
    }
    
    private void maintainSpeed(int speed){
            try {
                Thread.sleep((11 - speed) * 10);
            } catch (InterruptedException ex) {
                Logger.getLogger(Processor.class.getName()).log(Level.SEVERE, null, ex);
            }    
    }
    
    @Override
    public void run() {
        while (true) {
            maintainSpeed(gui.getSpeed());
            
            if(unitStep && !stepRunning){
                continue;               
            }
            
            if (freezed&&!unitStep) {
                continue;
            }
            if (restart) {
                gui.writeLog("Session ended. Restartig...!", cpuTime);
                restart = false;
                return;
            }
            medsch.execute(cpuTime);
            gui.updateActiveProcesses(sch.getActiveProcesses());
            if (sch.getActiveProcess() != null) {
                procHalted = false;
                Process pr = sch.getActiveProcess();
                pr.execute();
                lastExecProcess = pr;
            } else {
                if (medsch.isHalted()) {
                    gui.writeLog("System halted! ", cpuTime);
                    return; //processes over
                } else {
                    if (!procHalted) {
                        gui.writeLog("Processor halted! Waiting for secondary scheduler...", cpuTime);
                        procHalted = true;
                    }
                }
            }

            cpuTime++;
            if(cpuTime%20==0)stepRunning=false;
            gui.jTextField12.setText(cpuTime / 20 + " : " + cpuTime % 20);

        }
    }

}
