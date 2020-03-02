using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using DTO;
using BLL;
using DAL;

namespace TestRequests
{
    class Program
    {
        static void Main(string[] args)
        {

            List<Categorie> list = new List<Categorie>();

            list = CategorieManager.GetAllCategorie();

            foreach(Categorie categories in list)
            {
                Console.WriteLine(categories.nameCategorie);
            }

            Console.ReadLine();
        }
    }
}
