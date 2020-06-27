using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace SystemB
{
    public class Datos
    {
        private string token, dpi, fecha, direccion, genero;
        public Datos()
        {

        }

        public string Direccion
        {
            get
            {
                return direccion;
            }

            set
            {
                direccion = value;
            }
        }

        public string Dpi
        {
            get
            {
                return dpi;
            }

            set
            {
                dpi = value;
            }
        }

        public string Fecha
        {
            get
            {
                return fecha;
            }

            set
            {
                fecha = value;
            }
        }

        public string Genero
        {
            get
            {
                return genero;
            }

            set
            {
                genero = value;
            }
        }

        public string Token
        {
            get
            {
                return token;
            }

            set
            {
                token = value;
            }
        }
    }
}