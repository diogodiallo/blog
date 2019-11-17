<?php

namespace Core;
 
class Router
{
  protected $routes = [];
 
  const NO_ROUTE = 1;
 
  public function addRoute(Route $route)
  {
    if (!in_array($route, $this->routes))
    {
      $this->routes[] = $route;
    }
  }
 
  public function getRoute($url)
  {
    foreach ($this->routes as $route)
    {
      // If the route matches the URL
      if (($varsValues = $route->match($url)) !== false)
      {
        // If it has variables
        if ($route->hasVars())
        {
          $varsNames = $route->varsNames();
          $listVars = [];
 
          // We create a new key / value table
          // (key = name of the variable, value = its value)
          foreach ($varsValues as $key => $match)
          {
            // he first value fully contains the captured string (see the doc on preg_match)
            if ($key !== 0)
            {
              $listVars[$varsNames[$key - 1]] = $match;
            }
          }
 
          // This table of variables is assigned to the road
          $route->setVars($listVars);
        }
 
        return $route;
      }
    }
 
    throw new \RuntimeException('Aucune route ne correspond à l\'URL', self::NO_ROUTE);
  }
}