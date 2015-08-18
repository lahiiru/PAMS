
import java.util.ArrayList;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 *
 * @author Achini
 */
public class MedScheduler {

    ArrayList<Process> jobList;                                                 // List of processes selected by user to run
    Scheduler shortScheduler;                                                   // Reference to short term scheduler
    Processor processor;                                                        // Reference to processor instance
    int releasedProcessesCount = 0;                                             // Total released processes count by medium scheduler
    int processCount = 0;                                                       // Total processes selected to run
    MainGUI gui;                                                                // Reference to GUI instance
        
    public MedScheduler(Processor p, Scheduler sch) {
        processor = p;
        shortScheduler = sch;
        jobList = new ArrayList<Process>();
        
                                                                                //Entering the enabled process details to jobList
        try{
            for(int i=0;i<5;i++){
                if (processor.gui.chkboxList.get(i).isSelected()) {
                    jobList.add(new Process(i, Integer.parseInt(processor.gui.arrivalList.get(i).getText()), Integer.parseInt(processor.gui.serviceList.get(i).getText()), processor));
                    processCount++;
                }
            }
        }
        catch(Exception e){
            p.setRestart("Invalid user input.");
        }
                
    }

    public boolean isHalted() {
        return releasedProcessesCount == processCount;
    }

    public void execute(int cpuTime) {
        for (Object i : jobList.toArray()) {
            Process pr = (Process) i;
            if (pr.arrivalTime == cpuTime) {
                releasedProcessesCount++;
                processor.gui.writeLog("Process " + Character.toString((char) (65 + ((Process) i).index)) + " is added to ready queue...", processor.cpuTime);
                shortScheduler.addProcess(pr);
            }
        }
    }

}
