<?php


class Product
{
    private $id;
    private $name;
    private $type;
    private $picture_path;
    private $price;
    private $category;
    private $age_target;
    private $number_of_players;
    private $rating;
    private $numViews;
    private $numberSelles;
    private $inStock;
    private $productYear;
    private $colectional;
    /**
 * @param mixed $colectional
 */
public function setColectional($colectional): void
{
    $this->colectional = $colectional;
}

    /**
     * @return mixed
     */
    public function getColectional()
    {
        return $this->colectional;
    }
    /**
     * Product constructor.
     * @param $id
     * @param $name
     * @param $type
     * @param $picture_path
     * @param $price
     * @param $category
     * @param $age_target
     * @param $number_of_players
     * @param $rating
     * @param $inStock
     * @param $productYear
     */
    public function __construct($name, $type, $picture_path, $price, $category, $age_target,$number_of_players, $rating, $inStock, $productYear)
    {

        $this->name = $name;
        $this->type = $type;
        $this->picture_path = $picture_path;
        $this->price = $price;
        $this->category = $category;
        $this->age_target = $age_target;
        $this->number_of_players=$number_of_players;
        $this->rating = $rating;
        $this->inStock = $inStock;
        $this->productYear = $productYear;

    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type): void
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getPicturePath()
    {
        return $this->picture_path;
    }

    /**
     * @param mixed $picture_path
     */
    public function setPicturePath($picture_path): void
    {
        $this->picture_path = $picture_path;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price): void
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category): void
    {
        $this->category = $category;
    }

    /**
     * @return mixed
     */
    public function getAgeTarget()
    {
        return $this->age_target;
    }

    /**
     * @param mixed $age_target
     */
    public function setAgeTarget($age_target): void
    {
        $this->age_target = $age_target;
    }

    /**
     * @return mixed
     */
    public function getNumberOfPlayers()
    {
        return $this->number_of_players;
    }

    /**
     * @param mixed $number_of_players
     */
    public function setNumberOfPlayers($number_of_players): void
    {
        $this->number_of_players = $number_of_players;
    }

    /**
     * @return mixed
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param mixed $rating
     */
    public function setRating($rating): void
    {
        $this->rating = $rating;
    }

    /**
     * @return mixed
     */
    public function getNumViews()
    {
        return $this->numViews;
    }

    /**
     * @param mixed $numViews
     */
    public function setNumViews($numViews): void
    {
        $this->numViews = $numViews;
    }

    /**
     * @return mixed
     */
    public function getNumberSelles()
    {
        return $this->numberSelles;
    }

    /**
     * @param mixed $numberSelles
     */
    public function setNumberSelles($numberSelles): void
    {
        $this->numberSelles = $numberSelles;
    }

    /**
     * @return mixed
     */
    public function getInStock()
    {
        return $this->inStock;
    }

    /**
     * @param mixed $inStock
     */
    public function setInStock($inStock): void
    {
        $this->inStock = $inStock;
    }

    /**
     * @return mixed
     */
    public function getProductYear()
    {
        return $this->productYear;
    }

    /**
     * @param mixed $productYear
     */
    public function setProductYear($productYear): void
    {
        $this->productYear = $productYear;
    }


}