/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author D.ayeshan
 */
public class Test {
    
    int[] x = {2,6,45,32,1};
    int[] y = new int[5];
    
    
    void reverse(){
        for(int i=4;i>=0; i--){
            y[4-i]=x[i];
        }
        
        for(int j=0;j<=4;j++){
            x[j]=y[j];
        }
        
        for(int n : x){
            System.out.print(n +" ");
            
        }
        System.out.println("");
    }
    
    
    
    
    public static void main(String[] args) {
        
        Test t = new Test();
        t.reverse();
    }
    
    
    
}
