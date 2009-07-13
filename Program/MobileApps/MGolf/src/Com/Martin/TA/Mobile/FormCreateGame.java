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
public class FormCreateGame extends Form implements CommandListener{
    private Display display;
    private MGolf midlet;

    private final Command cmdKembali = new Command("Kembali", Command.BACK,1);
    private final Command cmdKirim = new Command("Kirim SMS", Command.SCREEN, 2);

    public FormCreateGame(MGolf midlet, Display display){
        super("Info Course");
        this.midlet = midlet;
        this.display = display;

        StringItem info = new StringItem("", "", StringItem.LAYOUT_LEFT);
        info.setText("Buat game baru.");

        TextField username = new TextField("username", "ketik username", 15, TextField.ANY);
        
        ChoiceGroup course = new ChoiceGroup("Course List", Choice.POPUP);
        course.append("Mentari Golf", null);
        course.append("Imperial Club - L.Karawaci", null);
        course.append("Mountain View GC", null);
        course.append("Sawangan Golf", null);
        course.append("Jakarta GC", null);

        ChoiceGroup tee = new ChoiceGroup("Tee Mark", Choice.POPUP);
        tee.append("Black", null);
        tee.append("Blue", null);
        tee.append("White", null);
        tee.append("Red", null);
        tee.append("Yellow", null);

        ChoiceGroup rule = new ChoiceGroup("Play Rule", Choice.POPUP);
        rule.append("18-Holes", null);
        rule.append("9-Out", null);
        rule.append("9-In", null);

        this.append(info);
        this.append(username);
        this.append(course);
        this.append(tee);
        this.append(rule);
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
