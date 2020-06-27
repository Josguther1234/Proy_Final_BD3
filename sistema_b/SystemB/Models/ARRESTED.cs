//------------------------------------------------------------------------------
// <auto-generated>
//     Este código se generó a partir de una plantilla.
//
//     Los cambios manuales en este archivo pueden causar un comportamiento inesperado de la aplicación.
//     Los cambios manuales en este archivo se sobrescribirán si se regenera el código.
// </auto-generated>
//------------------------------------------------------------------------------

namespace SystemB.Models
{
    using System;
    using System.Collections.Generic;
    
    public partial class ARRESTED
    {
        [System.Diagnostics.CodeAnalysis.SuppressMessage("Microsoft.Usage", "CA2214:DoNotCallOverridableMethodsInConstructors")]
        public ARRESTED()
        {
            this.FAMILY = new HashSet<FAMILY>();
        }
    
        public int id_arrested { get; set; }
        public int id_Person_arrested { get; set; }
        public System.DateTime date_of_capture { get; set; }
        public int id_crime { get; set; }
        public string description { get; set; }
        public int id_police_station { get; set; }
        public int id_agent { get; set; }
        public bool status { get; set; }
    
        public virtual AGENT AGENT { get; set; }
        public virtual CRIME CRIME { get; set; }
        public virtual PERSON PERSON { get; set; }
        public virtual police_station police_station { get; set; }
        [System.Diagnostics.CodeAnalysis.SuppressMessage("Microsoft.Usage", "CA2227:CollectionPropertiesShouldBeReadOnly")]
        public virtual ICollection<FAMILY> FAMILY { get; set; }
    }
}
