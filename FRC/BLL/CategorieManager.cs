using System;
using System.Collections.Generic;
using DAL;
using DTO;

namespace BLL
{
    public class CategorieManager
    {
        /*This method get all the locations listed in Hotel*/
        public static List<String> GetAllCategorie()
        {
            List<Categorie> categories = CategorieDB.GetAllCategorie();

            List<String> list = new List<string>();

            foreach(Categorie a in categories)
            {
                list.Add(a.nameCategorie);
            }

            return list;
        }
    }
}
