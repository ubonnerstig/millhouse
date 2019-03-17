<?php

class Post
{
    private $pdo;
    public $id;
    public $title;
    public $slug;
    public $description;
    public $createdBy;
    public $imageId;
    public $published;
    public $category;

    function __construct($pdo) {
        $this->pdo = $pdo;
    }
    
    public function createPost($inTitle, $inDescription, $inCreatdedBy, $inImageId, $inPublished, $inCategory)
    {
        $this->title = $inTitle;
        $this->slug = str_replace(" ", "_", strtolower($inTitle));
        $this->description = $inDescription;
        $this->createdBy = $inCreatdedBy;
        $this->imageId = $inImageId;
        $this->published = $inPublished;
        $this->category = $inCategory;

        //Add $_POST info to posts DB
        $statement = $this->pdo->prepare(
        "INSERT INTO posts (title, slug, description, created_by, image, published)
        VALUES (:title, :slug, :description, :created_by, :image_id, :published);"
        );
    
        $statement->execute([
        ":title"     => $this->title,
        ":slug"     => $this->slug,
        ":description"     => $this->description,
        ":created_by"     => $this->createdBy,
        ":image_id"     => $this->imageId,
        ":published"     => $this->published,
        ]);	
        
        $statement = $this->pdo->prepare("SELECT MAX(id) AS id FROM posts");	
        $statement->execute();
        $post_id = $statement->fetchAll(PDO::FETCH_ASSOC);

        $this->id = $post_id[0]["id"];
        
        $statement = $this->pdo->prepare(
        "INSERT INTO post_category (post_id, prod_category_id)
        VALUES (:post_id, :category_id);"
        );
    
        $statement->execute([
        ":post_id"     => $this->id,
        ":category_id"     => $this->category,
        ]);
    }

    public function singlePost($inPostId, $inSlug){
        $this->id = $inPostId;
        $this->slug = $inSlug;

        $statement = $this->pdo->prepare(
        "SELECT posts.*, posts.image AS image_id, images.image AS image, post_category.prod_category_id AS category_id, product_category.category AS category_name, users.username AS author
        FROM posts
        JOIN users
        ON users.user_id = posts.created_by
        JOIN images
        ON images.id = posts.image
        JOIN post_category
        ON post_category.post_id = posts.id
        JOIN product_category
        ON product_category.category_id = post_category.prod_category_id
        WHERE posts.id = :post_id;
        AND posts.slug = :slug");
    
        $statement->execute([
            ":post_id"     => $this->id,
            ":slug"     => $this->slug
        ]);
        $this->single_post = $statement->fetchAll(PDO::FETCH_ASSOC);
    
        return $this->single_post;
    }
}