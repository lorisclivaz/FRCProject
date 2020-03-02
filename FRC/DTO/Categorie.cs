using System;

namespace DTO
{
    public class Categorie
    {

        //Variables
        public int idCategorie { get; set; }

        public String nameCategorie { get; set; }

        //Constructors

        public Categorie()
        {

        }
        public Categorie(int idCategorie)
        {
            this.idCategorie = idCategorie;
        }

        public Categorie(String nameCategorie)
        {
            this.nameCategorie = nameCategorie;
        }

        public Categorie(int idCategorie, String nameCategorie)
        {
            this.idCategorie = idCategorie;
            this.nameCategorie = nameCategorie;
        }
    }
}
