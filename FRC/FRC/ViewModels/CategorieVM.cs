using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using DTO;
using DAL;
using BLL;
using System.ComponentModel.DataAnnotations;
using System.Web.Mvc;

namespace FRC.ViewModels
{
    public class CategorieVM
    {
        public IEnumerable<string> categories { get; set; }
        public string SelectedValue { get; set; }
    }
}