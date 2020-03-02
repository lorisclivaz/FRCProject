using System;
using System.Collections.Generic;
using System.Configuration;
using System.Data.SqlClient;
using DTO;


namespace DAL
{
    public class CategorieDB
    {

        public static List<Categorie> GetAllCategorie()
        {
            List<Categorie> results = null;
            string connectionString = ConfigurationManager.ConnectionStrings["DefaultConnection"].ConnectionString;

            try
            {
                using (SqlConnection cn = new SqlConnection(connectionString))
                {
                    string query = "Select * from Categorie";
                    SqlCommand cmd = new SqlCommand(query, cn);

                    cn.Open();

                    using (SqlDataReader dr = cmd.ExecuteReader())
                    {
                        while (dr.Read())
                        {
                            if (results == null)
                                results = new List<Categorie>();

                            Categorie categorie = new Categorie();

                            categorie.idCategorie = (int)dr["Id"];

                            categorie.nameCategorie = (string)dr["Name"];

                         


                            results.Add(categorie);

                        }
                    }
                }
            }
            catch (Exception e)
            {
                throw e;
            }

            return results;
        }
    }
}
