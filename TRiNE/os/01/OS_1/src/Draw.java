
/**
 * Description	:Engine for the brick game Copyright	:Copyright (c) 2014 Company
 * :Embla Software Innovations (Pvt) Ltd Created on	:2014.09.01
 *
 * @author :Chandimal
 * @version :1.0
 */
import java.awt.Canvas;
import java.awt.Color;
import java.awt.Dimension;
import java.awt.Graphics2D;
import java.awt.Rectangle;
import java.awt.Toolkit;
import java.awt.event.KeyEvent;
import java.awt.event.KeyListener;
import java.awt.image.BufferedImage;

public class Draw extends Canvas {

    private static final long serialVersionUID = 1L;

    BufferedImage buffer; // Create the buffer
    boolean started = false;
    int cpulseWidth = 1;
    int barThickness = 30;
    int width = 0;

    /**
     * Create the game using the width and the height specified
     */
    public Draw(Dimension dim) {
        buffer = new BufferedImage(dim.width, dim.height,
                BufferedImage.TYPE_INT_RGB);
        width = dim.width;
        this.setIgnoreRepaint(true); // Ignore repainting as we are doing all
        // the drawing stuff

    }

    public void drawBar(int processNo, int x, int time) {
        //int k = width/time;
        //System.out.println(k);
        if (!started) {
            drawAxis();
            started = true;
        }
               // extendProHisInterface(x);

        // Draw the buffer
        Graphics2D b = buffer.createGraphics();

        // Random color background
        Color c;//= Color.BLACK;
        //b.setColor(c);
        //b.fillRect(0, 0, buffer.getWidth(), buffer.getHeight());
        if (processNo == 1) {
            c = Color.RED;
        } else if (processNo == 2) {
            c = Color.YELLOW;
        } else if (processNo == 3) {
            c = Color.GREEN;
        } else if (processNo == 4) {
            c = Color.BLUE;
        } else {
            c = Color.PINK;
        }

        b.setColor(c);

        b.fillRect(cpulseWidth * x, processNo * barThickness, cpulseWidth, barThickness);
        System.out.println("ss" + cpulseWidth * x);
        if (((x + 1) % 2 == 0 || x == 0) && cpulseWidth < 3) {
            b.drawLine((x) * cpulseWidth, 0, (x) * cpulseWidth, buffer.getHeight());
        }
        // Paint the buffer on screen

        Graphics2D g = (Graphics2D) this.getGraphics();
        g.drawImage(buffer, 0, 0, this);
        Toolkit.getDefaultToolkit().sync();

        g.dispose();

    }

    private void drawAxis() {
        Graphics2D b = buffer.createGraphics();
        b.setColor(Color.GRAY);
        for (int i = 1; i <= 5; i++) {
            b.drawLine(0, i * barThickness, buffer.getWidth(), i * barThickness);
        }

        for (int i = 1; i <= buffer.getWidth() / 20; i++) {
            b.drawLine(20 * i, 0, 20 * i, buffer.getHeight());
        }

        Graphics2D g = (Graphics2D) this.getGraphics();
        g.drawImage(buffer, 0, 0, this);
        Toolkit.getDefaultToolkit().sync();

        g.dispose();
    }

//        void extendProHisInterface(int x){
//            
//            Graphics2D b = buffer.createGraphics();
//            Color c = Color.BLACK;
//            
//                c = Color.YELLOW;
//		b.setColor(c);
//		b.fillRect(x*10,0, 10,400);
//        }
    /**
     * Draw the image buffer
     */
    public void drawBuffer() {

    }

    /**
     * Update it to the screen
     */
    public void drawScreen() {

    }

}
