using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Mvc;
using FRC.ViewModels;
using BLL;
using DTO;

namespace FRC.Controllers
{
    public class HomeController : Controller
    {
        public ActionResult Index()
        {
            CategorieVM list = new CategorieVM();

            list.categories = CategorieManager.GetAllCategorie();
            return View(list);
        }

        public ActionResult About()
        {
            ViewBag.Message = "Your application description page.";

            return View();
        }

        public ActionResult Contact()
        {
            ViewBag.Message = "Your contact page.";

            return View();
        }
    }
}