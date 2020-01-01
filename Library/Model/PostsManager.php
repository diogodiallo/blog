<?php
namespace Model;
 
use \Core\Manager;
use \Entity\Post;
 
abstract class PostsManager extends Manager
{
  /**
   * Méthode permettant d'ajouter une news.
   * @param $post Post La news à ajouter
   * @return void
   */
  abstract protected function add(Post $post);
 
  /**
   * Méthode permettant d'enregistrer une news.
   * @param $post Post la news à enregistrer
   * @see self::add()
   * @see self::modify()
   * @return void
   */
  public function save(Post $post)
  {
    if ($post->isValid())
    {
      $post->isNew() ? $this->add($post) : $this->modify($post);
    }
    else
    {
      throw new \RuntimeException('L\'article doit être validé pour être enregistré');
    }
  }
 
  /**
   * Méthode renvoyant le nombre de post total.
   * @return int
   */
  abstract public function count();
 
  /**
   * Méthode permettant de supprimer une news.
   * @param $id int L'identifiant de la news à supprimer
   * @return void
   */
  abstract public function delete($id);
 
  /**
   * Méthode retournant une liste de news demandée.
   * @param $debut int La première news à sélectionner
   * @param $limite int Le nombre de news à sélectionner
   * @return array La liste des news. Chaque entrée est une instance de News.
   */
  abstract public function getList($debut = -1, $limite = -1);
 
  /**
   * Méthode retournant une news précise.
   * @param $id int L'identifiant de la news à récupérer
   * @return News La news demandée
   */
  abstract public function getUnique($id);
 
  /**
   * Méthode permettant de modifier une news.
   * @param $post post la news à modifier
   * @return void
   */
  abstract protected function modify(Post $post);
}
