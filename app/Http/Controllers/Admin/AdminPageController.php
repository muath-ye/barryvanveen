<?php
namespace Barryvanveen\Http\Controllers\Admin;

use Barryvanveen\Http\Controllers\Controller;
use Barryvanveen\Pages\Commands\CreatePageCommand;
use Barryvanveen\Pages\Commands\UpdatePageCommand;
use Barryvanveen\Pages\Page;
use Barryvanveen\Pages\PageRepository;
use Flash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Redirect;
use View;

class AdminPageController extends Controller
{
    /** @var PageRepository */
    private $pagesRepository;

    /** @var Request */
    private $request;

    /** @var array */
    protected $rules = [
        'title'  => 'required',
        'text'   => 'required',
        'online' => 'required',
    ];

    /** @var  array */
    protected $messages;

    /**
     * @param PageRepository $pagesRepository
     * @param Request        $request
     */
    public function __construct(PageRepository $pagesRepository, Request $request)
    {
        $this->pagesRepository = $pagesRepository;
        $this->request         = $request;

        $this->messages = [
            'title.required'  => trans('general.validation-title-required'),
            'text.required'   => trans('general.validation-text-required'),
            'online.required' => trans('general.validation-online-required'),
        ];

        parent::__construct();
    }

    /**
     * Return all pages.
     *
     * @return View
     */
    public function index()
    {
        $this->setPageTitle('Pagina\'s -- overzicht');

        $pages = $this->pagesRepository->all();

        return View::make('pages.admin.index', compact('pages'));
    }

    /**
     * Create page.
     *
     * @return View
     */
    public function create()
    {
        $this->setPageTitle('Pagina\'s -- toevoegen');

        // empty oage to populate form
        $page = new Page();

        return View::make('pages.admin.create', compact('page'));
    }

    /**
     * Store a new page.
     *
     * @return View
     */
    public function store()
    {
        $this->validate($this->request, $this->rules, $this->messages);

        $this->dispatch(
            new CreatePageCommand(
                $this->request->get('title'),
                $this->request->get('text'),
                $this->request->get('online')
            )
        );

        Flash::success(trans('general.pagina-toegevoegd'));

        return Redirect::route('admin.page');
    }

    /**
     * Edit page by its id.
     *
     * @param $id
     *
     * @return View
     */
    public function edit($id)
    {
        $this->setPageTitle('Pagina\'s -- aanpassen');

        $page = $this->pagesRepository->findAnyById($id);

        return View::make('pages.admin.edit', compact('page'));
    }

    /**
     * Update page with posted data.
     *
     * @param $id
     *
     * @return RedirectResponse
     */
    public function update($id)
    {
        $this->validate($this->request, $this->rules, $this->messages);

        $this->dispatch(
            new UpdatePageCommand(
                $id,
                $this->request->get('title'),
                $this->request->get('text'),
                $this->request->get('online')
            )
        );

        Flash::success(trans('general.pagina-aangepast'));

        return Redirect::route('admin.page');
    }
}
