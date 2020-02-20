using System;
using DTO;
using BLL;
using DAL;
using System.Collections.Generic;
using Microsoft.Extensions.Configuration;
using Microsoft.Extensions.DependencyInjection;
using System.IO;
using System.Reflection;
using Microsoft.AspNetCore.Hosting;
using Microsoft.AspNetCore.Builder;
using Microsoft.AspNetCore.Http;

namespace TestApp
{
    public class Program

    {
        private static IConfiguration _iconfiguration;

        static void Main(string[] args)
        {
            GetAppSettingsFile();
            PrintCategories();
        }

        static void GetAppSettingsFile()
        {
           
            Console.WriteLine(appRoot);

            var builder = new ConfigurationBuilder()

                                   .AddJsonFile("C:\\Users\\loris\\source\\repos\\lorisclivaz\\FRCProject\\TestApp\\appSetting.json", optional: false, reloadOnChange: true);
            _iconfiguration = builder.Build();
        }

        static void PrintCategories()
        {


            var categoriesDAL = new CategoriesDB(_iconfiguration);
            var listCatModel = categoriesDAL.GetAll();
            listCatModel.ForEach(item =>
            {
                Console.WriteLine(item.name);
            });
            Console.WriteLine("Press any key to stop.");
            Console.ReadKey();

        }
    }
}
