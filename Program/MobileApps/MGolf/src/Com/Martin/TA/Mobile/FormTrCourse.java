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
public class FormTrCourse extends Form implements CommandListener{
    private Display display;
    private MGolf midlet;

    private final Command cmdKembali = new Command("Kembali", Command.BACK,1);
    private final Command cmdKirim = new Command("Kirim SMS", Command.SCREEN, 2);

    public FormTrCourse(MGolf midlet, Display display){
        super("Info Course");
        this.midlet = midlet;
        this.display = display;

        StringItem info = new StringItem("", "", StringItem.LAYOUT_LEFT);
        info.setText("Dapatkan informasi pemain top score pada golf course yang tersedia.");

        ChoiceGroup course = new ChoiceGroup("Course List", Choice.POPUP);
        course.append("Mentari Golf", null);
        course.append("Imperial Club - L.Karawaci", null);
        course.append("Mountain View GC", null);
        course.append("Sawangan Golf", null);
        course.append("Jakarta GC", null);

        this.append(info);
        this.append(course);
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
