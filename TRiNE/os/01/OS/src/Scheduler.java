import java.util.ArrayList;

/**
 *
 * @author Achini
 */
public class Scheduler {
    
    ArrayList<Process> readyQueue=new ArrayList<Process>();                     // Ready queue for the processes
    boolean arrived=false;                                                      // Flag says new arrival is there or not
    Process runningProcess;
    public void addProcess(Process p){
        arrived=true;
        readyQueue.add(p);        
    }
    
    private Process getMinimumRTP(){                                            // Select and return the minimum remaining time process
        if(readyQueue.isEmpty())return null;
        Process min=readyQueue.get(0);
        for(Object i:readyQueue.toArray()){
            if(((Process)i).getRemainigLength()<min.getRemainigLength()){
                min=(Process)i;
            }
        }
        return min;
    }
    
    public Process getActiveProcess(){
        return getMinimumRTP();                                                 // Active process is minimum remaining time process, Since our algorithm is SRT
    }
    
    public ArrayList<Process> getActiveProcesses(){
        return readyQueue;                                                      // Processes both Running and Waiting
    }
}
