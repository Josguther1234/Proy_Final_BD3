using System;
using System.Collections.Generic;
using System.Linq;
using System.Net;
using System.Net.Http;
using System.Web.Http;
using SystemB.Models;

namespace SystemB.Controllers
{
    public class ArrestosController : ApiController
    {
        private System_BEntities db = new System_BEntities();
        private System_BEntities1 db1 = new System_BEntities1();
        private System_BEntities2 db2 = new System_BEntities2();
        private System_BEntities3 db3 = new System_BEntities3();
        [HttpGet]
        public HttpResponseMessage ArrestedPorId([FromBody]int id)
        {
            var infor2 = db2.vistaRequerida.Select(s => new
            {
                s.dpi,
                s.first_name,
                s.id_department
            }).ToList();


            //var info = db.ARRESTED.Where(w => w.id_Person_arrested == id)
            //    .Select(s => new
            //    {
            //        s.date_of_capture,
            //        s.id_crime,
            //        s.description,
            //        s.status
            //    }).ToList();
            return Request.CreateResponse(HttpStatusCode.OK, infor2);
        }

        [HttpPost]
        public HttpResponseMessage Consultar([FromBody]Datos dato)
        {
            try
            {
                if(dato.Token == "12345")
                {
                    var informa = db3.V_Crimenes.Where(w => w.dpi == dato.Dpi)
                    .Select(s => new
                    {
                        s.first_name,
                        s.last_name,
                        s.crime,
                        s.date_of_capture,
                        s.description
                    }).ToList();
                    if(informa.Count == 0)
                    {
                        return Request.CreateResponse(HttpStatusCode.OK, "limpio");
                    }
                    else
                    {
                        return Request.CreateResponse(HttpStatusCode.OK, informa);
                    }
                }
                else
                {
                    return Request.CreateResponse(HttpStatusCode.OK, "token inválido");
                }
            }
            catch (Exception error)
            {
                string respuesta = "99: Error" + error.Message;
                return Request.CreateResponse(HttpStatusCode.Conflict, respuesta);
            }

        }
    }
}