<?php
class Posts
{
    public static function all()
    {
        $data = DB::table("articles")->orderBy('id', 'DESC')->paginate(2);
        foreach ($data['data'] as $k => $v) {
            $data['data'][$k]->like_count = DB::table("article_like")->where('article_id', $v->id)->count();
            $data['data'][$k]->comment_count = DB::table("article_comment")->where('article_id', $v->id)->count();
        }
        return $data;
    }

    public static function detail($slug)
    {
        $data = DB::table("articles")->where("slug", $slug)->getOne();
        $data->languages = DB::raw("SELECT languages.id,languages.slug,languages.name FROM article_language 
        LEFT JOIN
        languages
        ON
        languages.id = language_id
        WHERE article_id={$data->id}")->getAll();

        $data->comments = DB::table("article_comment")->where("article_id", $data->id)->getAll();

        $data->category = DB::table("category")->where("id", $data->category_id)->getOne();

        $data->like_count = DB::table("article_like")->where('article_id', $data->id)->count();

        $data->comment_count = DB::table("article_comment")->where('article_id', $data->id)->count();

        return $data;
    }
}
