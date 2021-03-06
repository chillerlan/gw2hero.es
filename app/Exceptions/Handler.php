<?php namespace GW2Heroes\Exceptions;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler{

	/**
	 * A list of the exception types that should not be reported.
	 *
	 * @var array
	 */
	protected $dontReport = [
		AuthorizationException::class,
		HttpException::class,
		ModelNotFoundException::class,
		ValidationException::class,
	];

	/**
	 * Report or log an exception.
	 *
	 * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
	 *
	 * @param  \Exception $e
	 *
	 * @return void
	 */
	public function report(Exception $e) {
		return parent::report($e);
	}

	/**
	 * Render an exception into an HTTP response.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Exception               $e
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function render($request, Exception $e) {
		if ($e instanceof ModelNotFoundException) {
			$e = new NotFoundHttpException($e->getMessage(), $e);
		}

		return parent::render($request, $e);
	}

	protected function convertExceptionToResponse(Exception $e) {
		$status = ($e instanceof HttpException) ? $e->getStatusCode() : 500;
		$header = ($e instanceof HttpException) ? $e->getHeaders() : [];

		return response()->view("errors.500", ['exception' => $e], $status, $header);
	}
}
