import java.util.ArrayList;

/**
 *
 * @author Lahiru
 */
public class Scheduler {
    ArrayList<Process> readyQueue=new ArrayList<Process>();
    public Scheduler(){
    }
    
    public void addProcess(Process p){
        
        readyQueue.add(p);
    }
    
    private Process getMinimumRTP(){
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
        return getMinimumRTP();
    }
    
    public ArrayList<Process> getActiveProcesses(){
        return readyQueue;  //processes running and waiting
    }
}
