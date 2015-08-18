
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
    static int tot = 0;
    int arrivalTime, processLength, pc = 0;
    String state;
    Processor p;
    Scheduler sch;
    MedScheduler md;
    Color runningC = Color.GREEN;
    Color completedC = Color.GRAY;
    Color pausedC = Color.ORANGE;

    public Process(int index, int arrivalTime, int serviceTime, Processor p) {
        this.index = index;
        this.arrivalTime = arrivalTime * 20 
                ;
        processLength = serviceTime * 20;
        this.p = p;

    }

    public void execute() {
        //updating log
        if (p.lastExecProcess != this && p.lastExecProcess != null && p.lastExecProcess.getRemainigLength() != 0) {
            p.gui.writeLog("Process " + Character.toString((char) (65 + p.lastExecProcess.index)) + " is paused...", p.cpuTime);
            p.gui.pbarList.get(p.lastExecProcess.index).setForeground(pausedC);
            p.gui.pbarList.get(p.lastExecProcess.index).setString("Paused");
            if (pc == 0) {
                p.gui.writeLog("Process " + Character.toString((char) (65 + index)) + " is started.", p.cpuTime);
                p.gui.pbarList.get(index).setForeground(runningC);
                p.gui.pbarList.get(index).setString("Running");
            } else {
                p.gui.writeLog("Process " + Character.toString((char) (65 + index)) + " is resumed.", p.cpuTime);
                p.gui.pbarList.get(index).setForeground(runningC);
                p.gui.pbarList.get(index).setString("Running");
            }
        }
        if (p.lastExecProcess == null && this != null) {
            p.gui.writeLog("Processor started with process " + Character.toString((char) (65 + index)) + ".", p.cpuTime);
            p.gui.pbarList.get(index).setForeground(runningC);
            p.gui.pbarList.get(index).setString("Running");
        }
        if (p.lastExecProcess != this && p.lastExecProcess != null && p.lastExecProcess.getRemainigLength() == 0 && pc == 0) {
            p.gui.writeLog("Process " + Character.toString((char) (65 + index)) + " is started.", p.cpuTime); ///////// ????????
            p.gui.pbarList.get(index).setForeground(runningC);
            p.gui.pbarList.get(index).setString("Running");

        }
        if (p.lastExecProcess != this && p.lastExecProcess != null && p.lastExecProcess.getRemainigLength() == 0 && pc != 0) {
            p.gui.writeLog("Process " + Character.toString((char) (65 + index)) + " is resumed.", p.cpuTime);///////????????????
            p.gui.pbarList.get(index).setForeground(runningC);
            p.gui.pbarList.get(index).setString("Running");
        }

        pc++;
        if (getRemainigLength() == 0) {
            p.sch.readyQueue.remove(this);
        }

        //updating progress bars
        p.gui.pbarList.get(index).setValue(pc * 100 / processLength);

        //updating log
        if (this.getRemainigLength() == 0) {
            p.gui.writeLog("Process " + Character.toString((char) (65 + this.index)) + " is completed.", p.cpuTime);
            p.gui.pbarList.get(index).setForeground(completedC);
            p.gui.pbarList.get(index).setString("Completed");
        }
        //update progress bar, history, processor details
        p.gui.updateTimeline(this.index, p.cpuTime);
    }

    public int getRemainigLength() {

        return processLength - pc;
    }
}
