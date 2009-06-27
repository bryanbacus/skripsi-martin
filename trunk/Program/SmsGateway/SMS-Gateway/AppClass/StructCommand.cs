using System;
using System.Collections;
using System.Collections.Generic;
using System.Text;

namespace Com.Martin.SMS.Data {
    
    public struct StructCommand {

        public String CommandType;

        public String CommandName;

        public String DestinationNumber;

        private ArrayList Parameters;

        public void AddParameter(int index, String value) {
        }

        public void AddParameter(String value) {
        }

        public void RemoveParameter(int index) {
        }

        public void ClearParameter() {
        }

        public void TryToParseParameter(String Param) {
        }

        public String GetParameter(int index) {
            return String.Empty;
        }
    }
}
