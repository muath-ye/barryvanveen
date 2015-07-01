<?php namespace Barryvanveen\Http\Controllers\Admin;

use Barryvanveen\Blogs\Blog;
use Barryvanveen\Blogs\BlogRepository;
use Barryvanveen\Blogs\Commands\CreateBlogCommand;
use Barryvanveen\Blogs\Commands\UpdateBlogCommand;
use Barryvanveen\Forms\AdminBlogForm;
use Barryvanveen\Http\Controllers\Controller;
use Flash;
use Illuminate\Http\RedirectResponse;
use Redirect;
use Request;
use View;

class AdminBlogController extends Controller
{
    /** @var BlogRepository */
    private $blogRepository;

    /** @var AdminBlogForm */
    private $adminBlogForm;

    /**
     * @param BlogRepository $blogRepository
     * @param AdminBlogForm  $adminBlogForm
     */
    public function __construct(BlogRepository $blogRepository, AdminBlogForm $adminBlogForm)
    {
        $this->blogRepository = $blogRepository;
        $this->adminBlogForm  = $adminBlogForm;

        parent::__construct();
    }

    /**
     * Return all blogs.
     *
     * @return View
     */
    public function index()
    {
        $this->setPageTitle('Blog -- overzicht');

        $blogs = $this->blogRepository->all();

        return View::make('blog.admin.index', compact('blogs'));
    }

    /**
     * Create blogpost.
     *
     * @return View
     */
    public function create()
    {
        $this->setPageTitle('Blog -- toevoegen');

        // empty blog to populate form
        $blog = new Blog();

        return View::make('blog.admin.create', compact('blog'));
    }

    /**
     * Store a new blogpost.
     *
     * @return View
     */
    public function store()
    {
        $this->adminBlogForm->validate(Request::only([
            'title',
            'summary',
            'text',
            'publication_date',
            'online',
        ]));

        $this->dispatch(
            new CreateBlogCommand(
                Request::get('title'),
                Request::get('summary'),
                Request::get('text'),
                Request::get('publication_date'),
                Request::get('online')
            )
        );

        Flash::success(trans('general.blog-toegevoegd'));

        return Redirect::route('admin.blog');
    }

    /**
     * Edit blogpost by its id.
     *
     * @param $id
     *
     * @return View
     */
    public function edit($id)
    {
        $this->setPageTitle('Blog -- aanpassen');

        $blog = $this->blogRepository->findAnyById($id);

        return View::make('blog.admin.edit', compact('blog'));
    }

    /**
     * Update blogpost with posted data.
     *
     * @param $id
     *
     * @return RedirectResponse
     *
     * @throws FormValidationException
     */
    public function update($id)
    {
        // todo: omschrijven naar nieuwe validatie
        $this->adminBlogForm->validate(Request::only([
            'title',
            'summary',
            'text',
            'publication_date',
            'online',
        ]));

        $this->dispatch(
            new UpdateBlogCommand(
                $id,
                Request::get('title'),
                Request::get('summary'),
                Request::get('text'),
                Request::get('publication_date'),
                Request::get('online')
            )
        );

        Flash::success(trans('general.blog-aangepast'));

        return Redirect::route('admin.blog');
    }
}
