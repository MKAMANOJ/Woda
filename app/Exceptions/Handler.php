<?php

namespace App\Exceptions;

use App\EBP\Constants\General;
use Carbon\Carbon;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use GrahamCampbell\Exceptions\NewExceptionHandler as NewExceptionHandler;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Http\Middleware\ValidatePostSize;
use Illuminate\Http\Exceptions\PostTooLargeException;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class Handler
 * @package App\Exceptions
 */
class Handler extends NewExceptionHandler
{
    /**
     * @var string
     */
    private $redirectToAdminLogin = 'login';
    /**
     * @var string
     */
    private $redirectToHome = 'home.index';
    /**
     * @var
     */
    private $redirectTo;
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception               $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof BadRequestHttpException || $exception instanceof TokenMismatchException) {
            logger()->info('Might be Csrf token filed');

            return redirect('/');
        }
        if ($exception instanceof PostTooLargeException) {
            return response('File Too Large. Only upto 10 MB.', 422);
        }
        if ($exception instanceof AuthorizationException) {
            return $this->unauthorized($request, $exception);
        }

        if ($exception instanceof AuthenticationException) {
            return $this->unauthenticated($request, $exception);
        }

        if ($request->segment(1) == 'api') {
            if ($exception instanceof ModelNotFoundException || $exception instanceof NotFoundHttpException) {
                return response()->json([
                    'code'    => 404,
                    'message' => 'Page not found.',
                ]);
            }
        }

        if ($exception instanceof ModelNotFoundException || $exception instanceof NotFoundHttpException) {
            return $this->notFound($request, $exception);
        }

        return parent::render($request, $exception);
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request                 $request
     * @param  \Illuminate\Auth\AuthenticationException $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        if ($request->segment(1) == 'administrator') {
            $this->redirectTo = route($this->redirectToAdminLogin);
        } else {
            $this->redirectTo = route($this->redirectToHome);
        }

        return redirect()->guest($this->redirectTo)->with('error_message', 'Please login to continue.');
    }

    /**
     * Create a Symfony response for the given exception.
     *
     * @param  \Exception $e
     * @return mixed
     */
    protected function convertExceptionToResponse(Exception $e)
    {
        if (config('app.debug')) {
            $whoops = new \Whoops\Run;
            $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);

            return response()->make(
                $whoops->handleException($e),
                method_exists($e, 'getStatusCode') ? $e->getStatusCode() : 500,
                method_exists($e, 'getHeaders') ? $e->getHeaders() : []
            );
        }

        return parent::convertExceptionToResponse($e);
    }

    /**
     * Return a 404 view with status code 404 when the model is not found / url is not found.
     * @param $request
     * @param $exception
     * @return \Illuminate\Http\Response
     */
    private function notFound($request, $exception)
    {
        return response()->view('404')->setStatusCode(404);
    }

    /**
     * Return an access denied error.
     * @param                        $request
     * @param AuthorizationException $exception
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    protected function unauthorized($request, AuthorizationException $exception)
    {

    }
}
