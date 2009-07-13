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
import javax.microedition.lcdui.TextField;

/**
 *
 * @author Martin
 */
public class FormAddScore extends Form implements CommandListener{
    private Display display;
    private MGolf midlet;

    private final Command cmdKembali = new Command("Kembali", Command.BACK,1);
    private final Command cmdKirim = new Command("Kirim SMS", Command.SCREEN, 2);

    public FormAddScore(MGolf midlet, Display display){
        super("Info Course");
        this.midlet = midlet;
        this.display = display;

        StringItem info = new StringItem("", "", StringItem.LAYOUT_LEFT);
        info.setText("Update nilai games yg telah dibuat.");

        TextField gameid = new TextField("Games ID", "ketik Games ID", 15, TextField.ANY);

        TextField score = new TextField("Score", "", 5, TextField.NUMERIC);

        ChoiceGroup hole = new ChoiceGroup("Hole No:", Choice.POPUP);
        hole.append("1", null);
        hole.append("2", null);
        hole.append("3", null);
        hole.append("4", null);
        hole.append("5", null);
        hole.append("6", null);
        hole.append("7", null);
        hole.append("8", null);
        hole.append("9", null);
        hole.append("10", null);
        hole.append("11", null);
        hole.append("12", null);
        hole.append("13", null);
        hole.append("14", null);
        hole.append("15", null);
        hole.append("16", null);
        hole.append("17", null);
        hole.append("18", null);

        this.append(info);
        this.append(gameid);
        this.append(hole);
        this.append(score);
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
