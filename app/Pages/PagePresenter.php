<?php
namespace Barryvanveen\Pages;

use Barryvanveen\Markdown\Commands\MarkdownToHtmlCommand;
use Carbon\Carbon;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Laravelrus\LocalizedCarbon\LocalizedCarbon;
use McCool\LaravelAutoPresenter\BasePresenter;

class PagePresenter extends BasePresenter
{
    use DispatchesJobs;

    /**
     * @param Page $page
     */
    public function __construct(Page $page)
    {
        $this->resource = $page;
    }

    /**
     * Get route to page-item.
     *
     * @return string
     */
    public function url()
    {
        return route('page-item', ['page' => $this->resource->slug]);
    }

    /**
     * Get route to edit page in admin section.
     *
     * @return string
     */
    public function admin_edit_url()
    {
        return route('admin.page-edit', [$this->resource->id]);
    }

    /**
     * Get date of latest update in proper Dutch format.
     *
     * @return string
     */
    public function updated_at_formatted()
    {
        $date = new Carbon($this->resource->updated_at);

        return $date->format('d-m-Y H:i');
    }

    /**
     * Get date of latest update in a diffForHumans format.
     *
     * @return string
     */
    public function updated_at_for_humans()
    {
        $date = new LocalizedCarbon($this->resource->updated_at);

        return $date->diffForHumans();
    }

    /**
     * Retrieve the html belonging to the text markdown.
     *
     * @return string
     */
    public function html_text()
    {
        return $this->dispatch(
            new MarkdownToHtmlCommand(
                $this->resource->text
            )
        );
    }
}
