<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Web\StorageController;
use App\Models\Setting;
use App\Models\LocationSetting;
use App\Models\Language;
use App\Models\Category;

//use Illuminate\Support\Facades\View;
class SiteDataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
    // public function getlangscod()
    // {
    //     $List = Language::select('code')->get('code');
    //     return $List;
    // }

    public function FillStaticData()
    {
        $strgCtrlr = new StorageController();
        $path = $strgCtrlr->SitePath('image');
        $List = Setting::select(
            'id',
            'name1',
            'value1',
            'name2',
            'value2',
            'name3',
            'value3',
            'category',
            'dep',
            'sequence',
            'section',
            'location',
            'is_active',
        )->where('category', 'site-info')
            //->orWhere('category', 'header-info')
            ->get();

        $titlerow = $List->where('category', 'site-info')->where('dep', 'title')->first();
        $title = $titlerow->value1;
        // $desc = $titlerow->value2;
        // $meta = $titlerow->value3;
        $logorow = $List->where('category', 'site-info')->where('dep', 'logo')->first();
        $iconrow = $List->where('category', 'site-info')->where('dep', 'icon')->first();
        $favicon = $strgCtrlr->getPath($iconrow->value1, $path);
        $favicon = ($favicon == '' ? $strgCtrlr->DefaultPath('image') : $favicon);
        $logo = $strgCtrlr->getPath($logorow->value1, $path);
        $logo = ($logo == '' ? $strgCtrlr->DefaultPath('image') : $logo);
        // $whatsrow = $List->where('category', 'site-info')->where('dep', 'whatsapp')->first();
        // $whatsApp = $whatsrow->value1;
        // $whatsApp = \Str::replace('+','',$whatsApp);
        // $whatsApp=\Str::replace(' ','',$whatsApp);
        //header  info
        // $phonerow = $List->where('category', 'header-info')->where('dep', 'phone')->first();

        // $emailrow = $List->where('category', 'header-info')->where('dep', 'email')->first();

        // $h_social_list = $this->getSocialbyLocation('header-social');
        // $f_social_list = $this->getSocialbyLocation('footer-social');
//head && footer
        $List2 = Setting::select(
            'id',
            'name1',
            'value1',
            'name2',
            'value2',
            'name3',
            'value3',
            'category',
            'dep',
            'sequence',
            'section',
            'location',
            'is_active',
        )
            ->where(function ($query) {
                $query->where('category', 'header-info')
                    ->where('dep', 'header');
            })
            ->orWhere(function ($query) {
                $query->where('category', 'footer-info')
                    ->where('dep', 'footer');
            })
            ->get();
        $headerlist = $List2->where('category', 'header-info')->select('id', 'name1', 'value1');
        $footerlist = $List2->where('category', 'footer-info')->select('id', 'name1', 'value1');
        $mainarr = [
            "title" => $title,
            // "desc" => $desc,
            // "meta" => $meta,
            "favicon" => $favicon,
            "logo" => $logo,

            // "phonerow" => $phonerow,
            // "emailrow" => $emailrow,

            // "h_social_list" => $h_social_list,
            // "f_social_list" => $f_social_list,
            // "whatsapp" => $whatsApp,
            'headerlist' => $headerlist,
            'footerlist' => $footerlist,
        ];

        //View::share('sitetitle', $title);
        return $mainarr;

    }
    public function getCompanyData()
    {
        $List = Setting::select(
            'id',
            'name1',
            'value1',
            'name2',
            'value2',
            'name3',
            'value3',
            'category',
            'dep',
            'sequence',
            'section',
            'location',
            'is_active',
        )->where('category', 'header-info')->orWhere('category', 'site-info')->get();
        $titlerow = $List->where('category', 'site-info')->where('dep', 'title')->first();
        $emailrow = $List->where('category', 'header-info')->where('dep', 'email')->first();
        $arraydata = [
            'com_email' => $emailrow->value1,
            'com_title' => $titlerow->value1,
        ];

        return $arraydata;
    }
    public function FillTransData($lang = null)
    {
        $langs = $this->getlangs($lang);
        $transarr = [
            "langs" => $langs,
        ];

        return $transarr;
    }
    public function getSocialbyLocation($loc)
    {
        $Dblist = LocationSetting::wherehas('location', function ($query) use ($loc) {
            $query->where('name', $loc);
        })->wherehas('setting', function ($query) {
            $query->where('is_active', 1);
        })->with('location', 'setting')->orderBy('sequence')->get();
        $List = $Dblist->map(function ($locSetting) {
            return [
                'id' => $locSetting->id,
                'name' => $locSetting->setting->value1,
                'code' => $locSetting->setting->value2,
                'link' => $locSetting->setting->value3,
                'sequence' => $locSetting->sequence,
            ];
        });

        return $List;
    }

    public function getSlideData($loc)
    {
        $slidedata = [];
        if ($loc == 'home') {
            $titlerow = Setting::where('category', 'site-info')->where('dep', 'title')->first();
            $title = $titlerow->value1;
            $desc = $titlerow->value2;

            $slidedata = [
                'title' => $title,
                'desc' => $desc
            ];
        } else {
            $slidedata = [
                'title' => '',
                'desc' => ''
            ];
        }
        return $slidedata;
    }

    public function getlangs($current_lang_code = null)
    {

        if ($current_lang_code == null) {
            $List = Language::where('status', 1)->orderByDesc('is_default')->get();
        } else {
            $List = Language::where('status', 1)->whereNot('code', $current_lang_code)->orderByDesc('is_default')->get();
            $selected = Language::where('status', 1)->where('code', $current_lang_code)->first();
            $List->prepend($selected);
        }

        return $List;
    }

    //footer
    public function getfooterLocation($lang_id)
    {
        $Dblist = LocationSetting::wherehas('location', function ($query) {
            $query->where('name', 'footer-social-title')
                ->orwhere('name', 'footer-bottom')
                ->orWhere('name', 'Like', '%footer-sec-%');
        })->
            wherehas('post', function ($query) {
                $query->where('status', 1);
            })
            ->with([
                'location',
                'post.langposts' => function ($q) use ($lang_id) {
                    $q->where('lang_id', $lang_id);
                }
            ])->orderBy('sequence')->get();


        $List = $Dblist->map(function ($locPost) {
            if ($locPost->post && $locPost->post->langposts->first()) {
                return [
                    'id' => $locPost->id,
                    'loc_name' => $locPost->location->name,
                    'tr_title' => $locPost->post->langposts->first()->title_trans,
                    'tr_content' => $locPost->post->langposts->first()->content_trans,
                    'sequence' => $locPost->sequence,
                ];
            } else {
                return [
                    'id' => $locPost->id,
                    'loc_name' => $locPost->location->name,
                    'tr_title' => "",
                    'tr_content' => "",
                    'sequence' => $locPost->sequence,
                ];
            }

        });

        return $List;
    }
    //mainmenu
    public function getmainmenu($lang_id)
    {
        $Dblist = LocationSetting::wherehas('location', function ($query) {
            $query->where('name', 'main-menu');
        })->
            wherehas('post', function ($query) {
                $query->where('status', 1);
            })
            ->
            orWhereHas('category', function ($query) {
                $query->where('status', 1);
            })
            ->with([
                'location',
                'post.langposts' => function ($q) use ($lang_id) {
                    $q->where('lang_id', $lang_id);
                },
                'category.langposts' => function ($q) use ($lang_id) {
                    $q->where('lang_id', $lang_id);
                }
            ])->orderBy('sequence')->get();


        $List = $Dblist->map(function ($locPost) use ($lang_id) {
            //if($locPost->post && $locPost->post->langposts->first()){
            $tr_title = '';
            $tr_content = '';
            $slug = '';
            $sons = [];
            $code = '';
            if ($locPost->category_id > 0 && $locPost->category->langposts->first()) {
                $tr_title = $locPost->category->langposts->first()->title_trans;
                $slug = $locPost->category->slug;
                $code = $locPost->category->code;
                //  $tr_content =$locPost->category->langposts->first()->content_trans;
                $sons = $this->mapcategorylist($locPost->category->sons->where('status', 1), $lang_id);
            } else if ($locPost->post_id > 0 && $locPost->post->langposts->first()) {
                $tr_title = $locPost->post->langposts->first()->title_trans;
                $slug = $locPost->post->slug;
                $code = $locPost->post->code;
                //    $tr_content =$locPost->post->langposts->first()->content_trans;
            }
            return [
                'id' => $locPost->id,
                'category_id' => $locPost->category_id,
                'post_id' => $locPost->post_id,
                'loc_name' => $locPost->location->name,
                'tr_title' => $tr_title,
                // 'tr_content' => $locPost->post->langposts->first()->content_trans,                 
                'sequence' => $locPost->sequence,
                'sons' => $sons,
                'slug' => $slug,
                'code' => $code,

            ];


        });

        return $List;
    }
    public function mapcategorylist($Dblist, $lang_id)
    {
        $List = $Dblist->map(function ($category) use ($lang_id) {

            $tr_title = '';
            $tr_content = '';
            $transcat = $category->langposts->where('lang_id', $lang_id)->first();
            if ($transcat) {
                $tr_title = $transcat->title_trans;
                //  $tr_content =$locPost->category->langposts->first()->content_trans;
            }
            $slug = $category->slug;
            $sons = $this->mapcategorylist($category->sons->where('status', 1), $lang_id);
            return [
                'id' => 0,
                'category_id' => $category->id,
                'post_id' => 0,
                'loc_name' => '',
                'tr_title' => $tr_title,
                // 'tr_content' => $locPost->post->langposts->first()->content_trans,                 
                'sequence' => 0,
                'sons' => $sons,
                'slug' => $slug,
                'code' => $category->code,
            ];


        });

        return $List;
    }
    public function getcatinfo($lang_id, $slug)
    {

        $Dbitem = Category::with([
            'langposts' => function ($q) use ($lang_id) {
                $q->where('lang_id', $lang_id);
            },
            'sons'
        ])->orderBy('sequence')->where('slug', $slug)->first();

        $item = $this->mapcategory($Dbitem, $lang_id);
        //   return $item;

        return $item;
    }
    public function getcontactinfo($lang_id, $slug)
    {

        $category = $this->getcatwithposts($lang_id, $slug);
        $categorymap = $this->mapcontactwithform($category);
        $locationrow = Setting::where('category', 'site-info')->where('dep', 'location')->first();
        $location = $locationrow->value1;
        $categorymap['location'] = $location;
        return $categorymap;

    }
    public function mapcontactwithform($category)
    {
        $form = $this->mapformlist($category['posts']);

        return [
            'id' => $category['id'],
            'title' => $category['title'],
            'slug' => $category['slug'],
            'desc' => $category['desc'],
            'meta_key' => $category['meta_key'],
            'parent_id' => $category['parent_id'],
            'sequence' => $category['sequence'],
            'status' => $category['status'],
            // 'notes'=>$category['notes'],    
            'code' => $category['code'],
            'tr_title' => $category['tr_title'],
            'tr_content' => $category['tr_content'],
            'form' => $form,
        ];
    }
    public function getcatwithposts($lang_id, $slug)
    {        //projects and refs
        $Dbitem = Category::with([
            'langposts' => function ($q) use ($lang_id) {
                $q->where('lang_id', $lang_id);
            },
            'posts' => function ($q) use ($lang_id) {
                $q->where('status', 1)
                    ->with([
                        'langposts' => function ($q) use ($lang_id) {
                            $q->where('lang_id', $lang_id);
                        },
                        'mediaposts' => function ($q) {
                            $q->with('mediastore');
                        }

                    ])->orderBy('sequence');
            }
        ])->orderBy('sequence')->where('slug', $slug)->first();
        /*
        [
                    'mediaposts' => function ($q) use ($id) {
                        $q->with('mediastore');
                    }
                ]
        */
        $item = $this->mapcatwithpost($Dbitem, $lang_id);
        //   return $item;

        return $item;
    }
    public function gettranscat($lang_id)
    {        //projects and refs
        $Dbitem = Category::with([
            'langposts' => function ($q) use ($lang_id) {
                $q->where('lang_id', $lang_id);
            },
            'posts' => function ($q) use ($lang_id) {
                $q->where('status', 1)
                    ->with([
                        'langposts' => function ($q) use ($lang_id) {
                            $q->where('lang_id', $lang_id);
                        }

                    ])->orderBy('sequence');
            }
        ])->orderBy('sequence')->where('code', 'translate')->first();

        $item = $this->mapcatwithpost($Dbitem, $lang_id);


        return $item;
    }
    public function getcatwithpost($lang_id, $slug, $postslug)
    {        //projects and refs
        $Dbitem = Category::with([
            'langposts' => function ($q) use ($lang_id) {
                $q->where('lang_id', $lang_id);
            },
            'posts' => function ($q) use ($lang_id, $postslug) {
                $q->where('status', 1)->where('slug', $postslug)
                    ->with([
                        'langposts' => function ($q) use ($lang_id) {
                            $q->where('lang_id', $lang_id);
                        },
                        'mediaposts' => function ($q) {
                            $q->with('mediastore');
                        }

                    ])->orderBy('sequence');
            }
        ])->orderBy('sequence')->where('slug', $slug)->first();
        /*
        [
                    'mediaposts' => function ($q) use ($id) {
                        $q->with('mediastore');
                    }
                ]
        */
        $item = $this->mapcatpostArr($Dbitem, $lang_id);
        //   return $item;

        return $item;
    }

    public function getcatwithmedia($lang_id, $code)
    {        //projects and refs
        $Dbitem = Category::with([
            'langposts' => function ($q) use ($lang_id) {
                $q->where('lang_id', $lang_id);
            },
            'mediaposts' => function ($q) {
                $q->with('mediastore');
            }
        ])->orderBy('sequence')->where('code', $code)->first();
        $item = $this->mapcatwithmedia($Dbitem, $lang_id);
        //   return $item;     
        return $item;
    }

    public function mapcatwithmedia($category, $lang_id)
    {
        $tr_title = '';
        $tr_content = '';
        if ($category->langposts->first()) {
            $tr_title = $category->langposts->first()->title_trans;
            $tr_content = $category->langposts->first()->content_trans;
        }

        $medialist = $this->mapmedia($category->mediaposts);
        return [
            'id' => $category->id,
            'title' => $category->title,
            'slug' => $category->slug,
            'desc' => $category->desc,
            'meta_key' => $category->meta_key,
            'parent_id' => $category->parent_id,
            'sequence' => $category->sequence,
            'status' => $category->status,
            'notes' => $category->notes,
            'code' => $category->code,
            'tr_title' => $tr_title,
            'tr_content' => $tr_content,
            'mediastore' => $medialist,

        ];
    }

    public function mapcategory($category, $lang_id)
    {
        $tr_title = '';
        $tr_content = '';
        if ($category->langposts->first()) {
            $tr_title = $category->langposts->first()->title_trans;
            $tr_content = $category->langposts->first()->content_trans;
        }
        $pcode = $category->parent->code;
        $sons = $this->mapcategorylist($category->sons, $lang_id);
        return [
            'id' => $category->id,
            'title' => $category->title,
            'slug' => $category->slug,
            'desc' => $category->desc,
            'meta_key' => $category->meta_key,
            'parent_id' => $category->parent_id,
            'sequence' => $category->sequence,
            'status' => $category->status,
            'notes' => $category->notes,
            'code' => $category->code,
            'tr_title' => $tr_title,
            'tr_content' => $tr_content,
            'parent_code' => $pcode,

            'sons' => $sons,

        ];
    }

    public function mapcatwithpost($category, $lang_id)
    {

        $tr_title = '';
        $tr_content = '';
        if ($category->langposts->first()) {
            $tr_title = $category->langposts->first()->title_trans;
            $tr_content = $category->langposts->first()->content_trans;
        }

        $posts = $this->mappostlist($category->posts);

        return [
            'id' => $category->id,
            'title' => $category->title,
            'slug' => $category->slug,
            'desc' => $category->desc,
            'meta_key' => $category->meta_key,
            'parent_id' => $category->parent_id,
            'sequence' => $category->sequence,
            'status' => $category->status,
            'notes' => $category->notes,
            'code' => $category->code,
            'tr_title' => $tr_title,
            'tr_content' => $tr_content,

            'posts' => $posts,


        ];

    }
    public function mapcatpostArr($category, $lang_id)
    {

        $tr_title = '';
        $tr_content = '';
        if ($category->langposts->first()) {
            $tr_title = $category->langposts->first()->title_trans;
            $tr_content = $category->langposts->first()->content_trans;
        }

        $posts = $this->mappostlist($category->posts);
        $categoryArr = [
            'id' => $category->id,
            'title' => $category->title,
            'slug' => $category->slug,
            'desc' => $category->desc,
            'meta_key' => $category->meta_key,
            'parent_id' => $category->parent_id,
            'sequence' => $category->sequence,
            'status' => $category->status,
            'notes' => $category->notes,
            'code' => $category->code,
            'tr_title' => $tr_title,
            'tr_content' => $tr_content,

        ];
        return [
            'category' => $categoryArr,
            'posts' => $posts,
        ];

    }
    public function mappostlist($post)
    {
        $List = $post->map(function ($postmodel) {
            $tr_title = '';

            $tr_content = '';
            if ($postmodel->langposts->first()) {
                $tr_title = $postmodel->langposts->first()->title_trans;
                $tr_content = $postmodel->langposts->first()->content_trans;
            }
            $mediastorelist = $this->mapmedia($postmodel->mediaposts);

            return [
                'id' => $postmodel->id,
                'title' => $postmodel->title,
                'slug' => $postmodel->slug,
                'desc' => $postmodel->desc,
                //   'meta_key'=>$category->meta_key,

                'sequence' => $postmodel->sequence,
                'status' => $postmodel->status,
                'notes' => $postmodel->notes,
                'code' => $postmodel->code,
                'tr_title' => $tr_title,
                'tr_content' => $tr_content,
                'mediastore' => $mediastorelist
            ];
        });
        return $List;

    }
    //contact
    public function mapformlist($post)
    {

        $contact_name = $post->where('code', 'contact_name')->first()['tr_title'];
        $contact_email = $post->where('code', 'contact_email')->first()['tr_title'];
        $contact_subject = $post->where('code', 'contact_subject')->first()['tr_title'];
        $contact_message = $post->where('code', 'contact_message')->first()['tr_title'];
        $contact_send = $post->where('code', 'contact_send')->first()['tr_title'];
        $contact_success = $post->where('code', 'contact_success')->first()['tr_title'];
        $contact_error = $post->where('code', 'contact_error')->first()['tr_title'];

        return [
            'contact_name' => $contact_name,
            'contact_email' => $contact_email,
            'contact_subject' => $contact_subject,
            'contact_message' => $contact_message,
            'contact_send' => $contact_send,
            'contact_success' => $contact_success,
            'contact_error' => $contact_error,
        ];
    }
    public function mapmedia($mediaposts)
    {
        $List = $mediaposts->map(function ($mediapmodel) {

            return [
                'id' => $mediapmodel->mediastore->id,
                'name' => $mediapmodel->mediastore->name,
                'caption' => $mediapmodel->mediastore->caption,
                'title' => $mediapmodel->mediastore->title,
                'local_path' => $mediapmodel->mediastore->local_path,
                'type' => $mediapmodel->mediastore->type,
                'sequence' => $mediapmodel->sequence,
                'image_path' => $mediapmodel->mediastore->image_path
            ];
        });
        return $List;
    }
    public $mainpathArr = [];
    //getpath
    public function getpath($lang_code, $slug)
    {
        $curentlang = Language::where('code', $lang_code)->first();
        $lang_id = $curentlang->id;
        $homecatdb = Category::with([
            'langposts' => function ($q) use ($lang_id) {
                $q->where('lang_id', $lang_id);
            }
        ])->where('code', 'home')->first();
        $homecat = $this->mapcategoryPath($homecatdb, $lang_id, $curentlang->code);

        $Dbitem = Category::with([
            'langposts' => function ($q) use ($lang_id) {
                $q->where('lang_id', $lang_id);
            }
        ])->where('slug', $slug)->first();

        while ($Dbitem->code != 'main-menu') {
            $parentid = $Dbitem->parent_id;
            $item = $this->mapcategoryPath($Dbitem, $lang_id, $curentlang->code);
            $this->mainpathArr[] = $item;
            $Dbitem = $this->getbyid($parentid, $lang_id);
        }
        $this->mainpathArr[] = $homecat;
        $this->mainpathArr = array_reverse($this->mainpathArr);
        //   return $item;     
        return $this->mainpathArr;
    }
    public function getpathwithpost($lang_code, $slug, $postslug)
    {
        $curentlang = Language::where('code', $lang_code)->first();
        $lang_id = $curentlang->id;
        $homecatdb = Category::with([
            'langposts' => function ($q) use ($lang_id) {
                $q->where('lang_id', $lang_id);
            }
        ])->where('code', 'home')->first();
        $homecat = $this->mapcategoryPath($homecatdb, $lang_id, $curentlang->code);

        $Dbitem = Category::with([
            'langposts' => function ($q) use ($lang_id) {
                $q->where('lang_id', $lang_id);
            }
        ])->where('slug', $slug)->first();

        while ($Dbitem->code != 'main-menu') {
            $parentid = $Dbitem->parent_id;
            $item = $this->mapcategoryPath($Dbitem, $lang_id, $curentlang->code);
            $this->mainpathArr[] = $item;
            $Dbitem = $this->getbyid($parentid, $lang_id);
        }
        $this->mainpathArr[] = $homecat;
        $this->mainpathArr = array_reverse($this->mainpathArr);
        //   return $item;     
        return $this->mainpathArr;
    }
    public function getbyid($category_id, $lang_id)
    {
        $Dbitem = Category::with([
            'langposts' => function ($q) use ($lang_id) {
                $q->where('lang_id', $lang_id);
            }
        ])->where('id', $category_id)->first();
        return $Dbitem;
    }
    public function mapcategoryPath($category, $lang_id, $lang_code)
    {
        $tr_title = '';
        $urlpath = '#';
        $is_link = 0;
        if ($category->langposts->first()) {
            $tr_title = $category->langposts->first()->title_trans;
            //   $tr_content= $category->langposts->first()->content_trans;
        }
        if ($category->code == 'home') {
            $urlpath = url('lang', $lang_code);
            $is_link = 1;
        } else {

        }

        return [
            'id' => $category->id,
            //  'title'=>$category->title,
            'slug' => $category->slug,
            //   'desc'=>$category->desc,
            //   'meta_key'=>$category->meta_key,
            'parent_id' => $category->parent_id,
            //  'sequence'=>$category->sequence,
            //   'status'=>$category->status,             
            //  'notes'=>$category->notes,    
            'code' => $category->code,
            'tr_title' => $tr_title,
            //  'tr_content' =>$tr_content,                 
            'urlpath' => $urlpath,
            'is_link' => $is_link,

        ];
    }
    public function mapcategoryPathwithPost($category, $lang_id, $lang_code)
    {
        $tr_title = '';
        $urlpath = '#';
        $is_link = 0;
        if ($category->langposts->first()) {
            $tr_title = $category->langposts->first()->title_trans;
            //   $tr_content= $category->langposts->first()->content_trans;
        }
        if ($category->code == 'home') {
            $urlpath = url('lang', $lang_code);
            $is_link = 1;
        } else {

        }

        return [
            'id' => $category->id,
            //  'title'=>$category->title,
            'slug' => $category->slug,
            //   'desc'=>$category->desc,
            //   'meta_key'=>$category->meta_key,
            'parent_id' => $category->parent_id,
            //  'sequence'=>$category->sequence,
            //   'status'=>$category->status,             
            //  'notes'=>$category->notes,    
            'code' => $category->code,
            'tr_title' => $tr_title,
            //  'tr_content' =>$tr_content,                 
            'urlpath' => $urlpath,
            'is_link' => $is_link,

        ];
    }
    public function Fillfordash()
    {
        $strgCtrlr = new StorageController();
        $path = $strgCtrlr->SitePath('image');
        $List = Setting::select(
            'id',
            'name1',
            'value1',
            'name2',
            'value2',
            'name3',
            'value3',
            'category',
            'dep',
            'section',
            'location',
            'is_active',
        )->where('category', 'site-info')->get();
        $titlerow = $List->where('category', 'site-info')->where('dep', 'title')->first();
        $title = $titlerow->value1;
        $logorow = $List->where('category', 'site-info')->where('dep', 'logo')->first();
        $favicon = $strgCtrlr->getPath($logorow->value1, $path);
        $favicon = ($favicon == '' ? $strgCtrlr->DefaultPath('image') : $favicon);
        $logo = $strgCtrlr->getPath($logorow->value2, $path);
        $logo = ($logo == '' ? $strgCtrlr->DefaultPath('image') : $logo);
        $mainarr = [
            "title" => $title,
            "favicon" => $favicon,
            "logo" => $logo,
        ];
        return $mainarr;

    }

    public function gethomedata($lang_id)
    {        //projects and refs
        $ref = Category::where('code', 'references')->where('status', 1)->first();
      //  $main_banner = $this->getcatbycode($lang_id, 'main-banner');
       // $project_banner = $this->getcatbycode($lang_id, 'project-banner');
        if ($ref) {
            $ref = $this->getcatwithposts($lang_id, $ref->slug);
        }
        $homearr = [
            "references" => $ref,
        //    "main_banner" => $main_banner,
           // "project_banner" => $project_banner,
        ];
        return $homearr;
    }
    public function getcatalog($lang_id)
    {        //projects and refs
        $catalog = Category::where('code', 'catalog')->where('status', 1)->first();
        if ($catalog) {
            $catalog = $this->getcatwithmedia($lang_id, $catalog->slug);
        }

        return $catalog;
    }
    public function getcatbycode($lang_id, $code)
    {        //projects and refs
        $catalog = Category::where('code', $code)->where('status', 1)->first();
        if ($catalog) {
            $catalog = $this->getcatwithmedia($lang_id, $code);
        }

        return $catalog;
    }


    //saraha
    public function getheaderpage()
    {
        $catmodel = Category::where('slug', 'contact')->select('id', 'code')->first();
        return view("admin.page.add");
    }
    public function getfooterpage($slug)
    {
        $catmodel = Category::where('slug', $slug)->first();
        return view("admin.page.add");
    }
    public function getmenubyloc($loc)
    {
        $Dblist = LocationSetting::wherehas('location', function ($query) use ($loc) {
            $query->where('name', $loc);
        })->where(function ($query) {
            $query->wherehas('category', function ($query) {
                $query->where('status', 1);
            })
                ->orWhereHas('post', function ($query) {
                    $query->where('status', 1);
                });
        })
            //   ->
            //   wherehas('post', function ($query)  {
            //     $query->where('status',1);
            //   })

            //   ->
            //   wherehas('category', function ($query)  {
            //     $query->where('status',1);
            //   })
            ->with([
                'location',
                'post' => function ($q) {
                    $q->where('status', 1);
                }
                ,
                'category' => function ($q) {
                    $q->where('status', 1);
                }
            ])->orderBy('sequence')->get();


        $List = $Dblist->map(function ($locPost) {
            //if($locPost->post && $locPost->post->langposts->first()){
            $tr_title = '';
            $tr_content = '';
            $slug = '';
            $sons = [];
            $code = '';
            if ($locPost->category_id > 0) {
                $tr_title = $locPost->category->title;
                $slug = $locPost->category->slug;
                $code = $locPost->category->code;
                $urlpath = url('page', $slug);
                //  $tr_content =$locPost->category->langposts->first()->content_trans;
//    $sons=  $this->mapcategorylist($locPost->category->sons->where('status',1),$lang_id);
            } else if ($locPost->post_id > 0) {
                $tr_title = $locPost->post->title;
                $slug = $locPost->post->slug;
                $code = $locPost->post->code;
                //    $tr_content =$locPost->post->langposts->first()->content_trans;
            }

            return [
                'id' => $locPost->id,
                'category_id' => $locPost->category_id,
                'post_id' => $locPost->post_id,
                'loc_name' => $locPost->location->name,
                'tr_title' => $tr_title,
                // 'tr_content' => $locPost->post->langposts->first()->content_trans,                 
                'sequence' => $locPost->sequence,
                // 'sons' =>$sons, 
                'slug' => $slug,
                'code' => $code,
                'urlpath' => $urlpath,

            ];


        });

        return $List;
    }

    //question
    public function getquescatbyloc($loc, $lang_id)
    {
        $langcode = Language::find($lang_id)->code;
        $Dblist = LocationSetting::wherehas('location', function ($query) use ($loc) {
            $query->where('name', $loc);
        })->where(function ($query) {
            $query->wherehas('category', function ($query) {
                $query->where('status', 1);
            });
        })
            //   ->
            //   wherehas('post', function ($query)  {
            //     $query->where('status',1);
            //   })

            //   ->
            //   wherehas('category', function ($query)  {
            //     $query->where('status',1);
            //   })

            ->with([
                'location',
                'category.langposts' => function ($q) use ($lang_id) {
                    $q->where('lang_id', $lang_id);
                }
                ,
                'category.mediaposts' => function ($q) {
                    $q->with('mediastore');
                }
            ])->orderBy('sequence')->get();
        $List = $Dblist->map(function ($locPost) use ($langcode) {
            //if($locPost->post && $locPost->post->langposts->first()){
            $tr_title = '';
            //  $tr_content ='';
            $slug = '';

            $code = '';
            // if($locPost->category_id>0){
            if ($locPost->category->langposts->first()) {
                $tr_title = $locPost->category->langposts->first()->title_trans;
            }
            $image_path = "";
            if ($locPost->category->mediaposts->first()) {
                $image_path = $locPost->category->mediaposts->first()->mediastore->image_path;
            }

            $slug = $locPost->category->slug;
            $code = $locPost->category->code;

            $urlpath = url($langcode, ['quiz', $slug]);
            //  $tr_content =$locPost->category->langposts->first()->content_trans;

            // }

            return [
                'id' => $locPost->id,
                'category_id' => $locPost->category_id,
                'loc_name' => $locPost->location->name,
                'tr_title' => $tr_title,
                // 'tr_content' => $locPost->post->langposts->first()->content_trans,                 
                'sequence' => $locPost->sequence,

                'slug' => $slug,
                'code' => $code,
                'urlpath' => $urlpath,
                'image_path' => $image_path
            ];


        });

        return $List;
    }

    public function getcategory($slug, $lang_id)
    {
        $langmodel = Language::find($lang_id);
        $langcode = $langmodel->code;
        $Dblist = Category::with([
            'langposts' => function ($q) use ($lang_id) {
                $q->where('lang_id', $lang_id);
            },
            'mediaposts.mediastore'
        ])->where('status', 1)->where('slug', $slug)->first();
    $object_arr= $this->map_quiz_category( $Dblist, $langcode);
        return $object_arr;
    }

    public function map_quiz_category($category, $lang_code)
    {
        $slug="";
        $tr_title = '';
        $tr_content = '';
        $urlpath = '#';
        $image_path = '';
        $image_alt = "";
        $meta_key="";
        $code="";
        $id=0;
      //  $is_link = 0;
      if($category){
       $id= $category->id;
        if ($category->langposts->first()) {
            $slug= $category->slug;
            $tr_title = $category->langposts->first()->title_trans;
            $tr_content = $category->langposts->first()->content_trans;
            if($category->mediaposts->first()){
                $image_path = $category->mediaposts->first()->mediastore->image_path;
                $image_alt = $category->mediaposts->first()->mediastore->name . $category->mediaposts->first()->mediastore->caption;
              
            }

             $urlpath = url($lang_code, ['quiz', $category->slug]);
            $meta_key= $category->meta_key;
            $code= $category->code;
        }
      }
    
        return [
            'id' =>$id,
            'slug' =>  $slug,
            'meta_key' =>  $meta_key,
         'code' => $code,
            'tr_title' => $tr_title,
            'tr_content' => $tr_content,
            'urlpath' => $urlpath,
            'image_path' => $image_path,
            'image_alt' => $image_alt,
            // 'is_link'=>$is_link,
        ];
    }

    //translate
    public function getbycode($lang_id,$codearr)
    {        //projects and refs
        $Dbitem = Category::with([            
            'posts' => function ($q) use ($lang_id,$codearr) {
                $q->where('status', 1)->whereIn('code', $codearr)
                    ->with([
                        'langposts' => function ($q) use ($lang_id) {
                            $q->where('lang_id', $lang_id);
                        }

                    ]);
            }
        ])->where('code', 'translate')->first();
        $item = $this->maptranslist($Dbitem->posts);
        return $item;
    }
    public function maptranslist($posts)
    {
        $List = $posts->map(function ($postmodel) {
            $tr_title = '';
            $tr_content = '';
            if ($postmodel->langposts->first()) {
                $tr_title = $postmodel->langposts->first()->title_trans;
                $tr_content = $postmodel->langposts->first()->content_trans;
            }           
            return [                
                'title' => $postmodel->title,                 
                'code' => $postmodel->code,
                'tr_title' => $tr_title,
                'tr_content' => $tr_content,            
            ];
        });
        return $List;

    }
    public function gettrans($tr_arr,$title,$code=null)
    {
        $tr_val="";
     if(isset($code)){
        if($tr_arr->where('title',$title)->where('code',$code)->first()){
            $tr_val=$tr_arr->where('title',$title)->where('code',$code)->first()['tr_title'];
        }
        
     }else{
        if($tr_arr->where('title',$title)->first()){
            $tr_val=$tr_arr->where('title',$title)->first()['tr_title'];
        }
       
     }
 
        return $tr_val;
    }
   

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
