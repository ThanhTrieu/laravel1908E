<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tags';

    public function products()
    {
        return $this->belongsToMany('App\Model\Product','product_tag', 'tags_id','products_id');
    }

    public function insertDataTag($name, $slug, $title, $meta, $desc)
    {
        $tag = new Tag;

        $tag->name_tag = $name;
        $tag->slug_tag = $slug;
        $tag->title_seo = $title;
        $tag->meta_seo = $meta;
        $tag->description_seo = $desc;
        $tag->created_at = date('Y-m-d H:i:s');
        $tag->updated_at = null;
        // luu vao db
        if($tag->save()){
            return true;
        }
        return false;
        /*
        DB::table('tags')->insert([
            'name_tag' =>
        ])
        */
    }

    public function updateTag($name, $id)
    {
        $tag = Tag::find($id);
        if($tag){
            $tag->name_tag = $name;

            if($tag->save()){
                return true;
            }
        }

        return false;
    }

    public function deleteTag($id)
    {
        $tag = Tag::find($id);
        if($tag){
            if($tag->delete()){
                return true;
            }
        }
        return false;
    }
}
