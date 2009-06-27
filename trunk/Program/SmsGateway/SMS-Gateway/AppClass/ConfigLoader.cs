using System;
using System.Collections.Generic;
using System.Text;

namespace Com.Martin.SMS.Processor {

    class ConfigLoader {

        public Com.Martin.SMS.Command.AbstractCommand CreateCommand(String CommandType, String CommandName) {
            throw new Com.Martin.SMS.Exception.SMSException();
        }
    }
}
