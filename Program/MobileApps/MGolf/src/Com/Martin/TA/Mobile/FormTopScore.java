/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

package Com.Martin.TA.Mobile;

import javax.microedition.lcdui.Choice;
import javax.microedition.lcdui.ChoiceGroup;
import javax.microedition.lcdui.Command;
import javax.microedition.lcdui.CommandListener;
import javax.microedition.lcdui.Display;
import javax.microedition.lcdui.Displayable;
import javax.microedition.lcdui.Form;
import javax.microedition.lcdui.StringItem;

/**
 *
 * @author Martin
 */
public class FormTopScore extends Form implements CommandListener{
    private Display display;
    private MGolf midlet;

    private final Command cmdKembali = new Command("Kembali", Command.BACK,1);
    private final Command cmdKirim = new Command("Kirim SMS", Command.SCREEN, 2);

    public FormTopScore(MGolf midlet, Display display){
        super("Info Course");
        this.midlet = midlet;
        this.display = display;

        StringItem info = new StringItem("", "", StringItem.LAYOUT_LEFT);
        info.setText("Dapatkan informasi 3 Top Player IJGC.");

        this.append(info);
        this.addCommand(cmdKembali);
        this.addCommand(cmdKirim);
        this.setCommandListener(this);
        this.display.setCurrent(this);
    }

    public void commandAction(Command c, Displayable d) {
        if(c == cmdKembali){
            this.display.setCurrent(this.midlet.list);
        }
    }

}
