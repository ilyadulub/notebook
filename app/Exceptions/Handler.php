<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $e)
    {
        $e = $this->replaceErrorMessages($request, $e);

        return parent::render($request, $e);
    }

    protected function replaceErrorMessages(Request $request, Throwable $e): Throwable
    {
        if ($e instanceof NotFoundHttpException) {
            $e = new NotFoundHttpException('The requested resource is not found.', $e);
        } elseif ($e instanceof ModelNotFoundException) {
            $modelName = Str::lower(class_basename($e->getModel()));
            $e = new NotFoundHttpException("The $modelName does not exist.", $e);
        }

        return $e;
    }
}
