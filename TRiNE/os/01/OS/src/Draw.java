
import java.awt.Canvas;
import java.awt.Color;
import java.awt.Dimension;
import java.awt.Graphics2D;
import java.awt.Toolkit;
import java.awt.image.BufferedImage;

public class Draw extends Canvas {

    BufferedImage buffer;                                                       // Create the buffer
    private boolean started = false;                                            // Is simulation started
    private final boolean stripsOn = true;                                      // Is vertical strips on
    private final int uStepWidth = 1;                                           // Width of a micro step
    private final int barHeight = 30;                                           // Height of a bar
    private int uUnitsPerUnit;                                                  // Micro units per unit

    public Draw(Dimension dim, int uUnits) {
        buffer = new BufferedImage(dim.width, dim.height, BufferedImage.TYPE_INT_RGB);
        uUnitsPerUnit = uUnits;
        this.setIgnoreRepaint(true);                                            // Ignore repainting as we are doing all
    }

    public void drawBar(int processNo, int x) {
        if (!started) {
            drawAxis();
            started = true;
        }

        Graphics2D b = buffer.createGraphics();

        Color c;

        if (processNo == 1) {                                                   //Set colours for each process
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
                                                                                // Draw a small step
        b.fillRect(uStepWidth * x, processNo * barHeight, uStepWidth, barHeight);
                                                                                // Draw strips
        if (stripsOn) {
            if ((x + 1) % 2 == 0) {
                b.drawLine((x + 1) * uStepWidth, 0, (x + 1) * uStepWidth, buffer.getHeight());
            }
        }

                                                                                // Paint new image on screen
        Graphics2D graphic = (Graphics2D) this.getGraphics();
        graphic.drawImage(buffer, 0, 0, this);
        Toolkit.getDefaultToolkit().sync();
        graphic.dispose();

    }

    private void drawAxis() {
        Graphics2D graphic = buffer.createGraphics();
        graphic.setColor(Color.GRAY);
        // Draw horizontal grids
        for (int i = 1; i <= 5; i++) {
            graphic.drawLine(0, i * barHeight, buffer.getWidth(), i * barHeight);
        }
        // Draw vertical grids
        for (int i = 1; i <= buffer.getWidth() / uUnitsPerUnit; i++) {
            graphic.drawLine(uUnitsPerUnit * i, 0, uUnitsPerUnit * i, buffer.getHeight());
        }
        // Paint grids on screen
        graphic = (Graphics2D) getGraphics();
        graphic.drawImage(buffer, 0, 0, this);
        Toolkit.getDefaultToolkit().sync();

        graphic.dispose();
    }

}
