
import java.awt.Color;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 *
 * @author Warunika
 */
public class Process {

    int index;
    int arrivalTime, processLength, executedLength = 0;                         //processLength = service time of the process
    Processor p;                                                                //Reference to Processor
    Color runningC = Color.GREEN;                                               //Color of running process = Green
    Color completedC = Color.GRAY;                                              //Color of completed process = Gray
    Color pausedC = Color.ORANGE;                                               //Color of paused process = Orange

    public Process(int index, int arrivalTime, int serviceTime, Processor p) {
        this.index = index;
        this.arrivalTime = arrivalTime * p.microStepsPerStep;
        processLength = serviceTime * p.microStepsPerStep;
        this.p = p;

    }

    public void execute() {
                                                                                //updating the log and progress bars
                                                                                //when the processor is just started
        if (p.lastExecutedProcess == null && this != null) {
            p.gui.writeLog("Processor started with process " + Character.toString((char) (65 + index)) + ".", p.cpuTime);
            p.gui.pbarList.get(index).setForeground(runningC);
            p.gui.pbarList.get(index).setString("Running");
        }
                                                                                //if the last executed process is paused...
        if (p.lastExecutedProcess != this && p.lastExecutedProcess != null && p.lastExecutedProcess.getRemainigLength() != 0) {
            p.gui.writeLog("Process " + Character.toString((char) (65 + p.lastExecutedProcess.index)) + " is paused...", p.cpuTime);
            p.gui.pbarList.get(p.lastExecutedProcess.index).setForeground(pausedC);
            p.gui.pbarList.get(p.lastExecutedProcess.index).setString("Paused");
                                                                                //if the current running process is newly started
            if (executedLength == 0) {
                p.gui.writeLog("Process " + Character.toString((char) (65 + index)) + " is started.", p.cpuTime);
                p.gui.pbarList.get(index).setForeground(runningC);
                p.gui.pbarList.get(index).setString("Running");
            } else {                                                            //if the current process is resumed from paused state
                p.gui.writeLog("Process " + Character.toString((char) (65 + index)) + " is resumed.", p.cpuTime);
                p.gui.pbarList.get(index).setForeground(runningC);
                p.gui.pbarList.get(index).setString("Running");
            }
        }
                                                                                //if last executed process is finished and a new process is started
        if (p.lastExecutedProcess != this && p.lastExecutedProcess != null && p.lastExecutedProcess.getRemainigLength() == 0 && executedLength == 0) {
            p.gui.writeLog("Process " + Character.toString((char) (65 + index)) + " is started.", p.cpuTime); 
            p.gui.pbarList.get(index).setForeground(runningC);
            p.gui.pbarList.get(index).setString("Running");

        }                                                                       //if last executed process is finished and a new process is resumed
        if (p.lastExecutedProcess != this && p.lastExecutedProcess != null && p.lastExecutedProcess.getRemainigLength() == 0 && executedLength != 0) {
            p.gui.writeLog("Process " + Character.toString((char) (65 + index)) + " is resumed.", p.cpuTime);
            p.gui.pbarList.get(index).setForeground(runningC);
            p.gui.pbarList.get(index).setString("Running");
        }

        executedLength++;                                                       //incerment the pointer of the current running process
        
        if (getRemainigLength() == 0) {                                         //if the current process is finished, remove it from ready Queue
            p.shortScheduler.readyQueue.remove(this);
            p.gui.writeLog("Process " + Character.toString((char) (65 + this.index)) + " is completed.", p.cpuTime);
            p.gui.pbarList.get(index).setForeground(completedC);
            p.gui.pbarList.get(index).setString("Completed");
        }
                                                                                //updating progress bars
        try{
            p.gui.pbarList.get(index).setValue(executedLength * 100 / processLength);
        }
        catch(Exception e){
            p.setRestart("Null process found.");                                // Make run time error if process length is invalid
        }
                                                                                //update the timeline
        p.gui.updateTimeline(this.index, p.cpuTime);
    }
                                                                                //method to get the remainig lenght of the current process
    public int getRemainigLength() {
        return processLength - executedLength;                                  //remaining length = processLength - ececuted Length
    }
}
