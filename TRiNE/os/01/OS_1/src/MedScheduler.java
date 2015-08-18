
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

    ArrayList<Process> jobList;
    Scheduler shortScheduler;
    Processor processor;
    int releasedProcessesCount = 0;
    int processCount = 0;
    MainGUI gui;
    int arrivalTime[]={Integer.parseInt(processor.gui.jTextField1.getText()),Integer.parseInt(processor.gui.jTextField2.getText()),Integer.parseInt(processor.gui.jTextField3.getText()),
        Integer.parseInt(processor.gui.jTextField4.getText()),Integer.parseInt(processor.gui.jTextField5.getText())};
    int serviceTime[]={Integer.parseInt(processor.gui.jTextField6.getText()),Integer.parseInt(processor.gui.jTextField7.getText()),Integer.parseInt(processor.gui.jTextField8.getText()),
    Integer.parseInt(processor.gui.jTextField9.getText()),Integer.parseInt(processor.gui.jTextField10.getText())};

    
    public MedScheduler(Processor p, Scheduler sch) {
        processor = p;

        shortScheduler = sch;
        jobList = new ArrayList<Process>();
        
        
            if (processor.gui.chkboxList.get(0).isSelected()) {
                jobList.add(new Process(0, Integer.parseInt(processor.gui.jTextField1.getText()), Integer.parseInt(processor.gui.jTextField6.getText()), processor));
                processCount++;
            }
     
       
            if (processor.gui.chkboxList.get(1).isSelected()) {
                jobList.add(new Process(1, Integer.parseInt(processor.gui.jTextField2.getText()), Integer.parseInt(processor.gui.jTextField7.getText()), processor));
                processCount++;
            }
        
            if (processor.gui.chkboxList.get(2).isSelected()) {
                jobList.add(new Process(2, Integer.parseInt(processor.gui.jTextField3.getText()), Integer.parseInt(processor.gui.jTextField8.getText()), processor));
                processCount++;
            }
        
            if (processor.gui.chkboxList.get(3).isSelected()) {
                jobList.add(new Process(3, Integer.parseInt(processor.gui.jTextField4.getText()), Integer.parseInt(processor.gui.jTextField9.getText()), processor));
                processCount++;
            }
    
        
            if (processor.gui.chkboxList.get(4).isSelected()) {
                jobList.add(new Process(4, Integer.parseInt(processor.gui.jTextField5.getText()), Integer.parseInt(processor.gui.jTextField10.getText()), processor));
                processCount++;
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
