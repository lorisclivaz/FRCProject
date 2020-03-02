using System;
using System.Collections.Generic;
using DAL;
using DTO;

namespace BLL
{
    public class CategorieManager
    {
        /*This method get all the locations listed in Hotel*/
        public static List<Categorie> GetAllCategorie()
        {
            List<Categorie> categories = CategorieDB.GetAllCategorie();

            return categories;
        }
    }
}
