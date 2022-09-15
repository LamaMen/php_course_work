<?php

namespace App\Http\Controllers;


use App\Mail\NewManInGroupCreated;
use App\Mail\OrderCreated;
use App\Repositories\OrdersRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Mail;

class OrdersController extends Controller
{
    private OrdersRepository $repository;

    function __construct(OrdersRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create(Request $request): View|RedirectResponse
    {
        $inp = $request->input();
        $this->repository->create($inp['groupId']);

        Mail::send(new NewManInGroupCreated($inp['groupId']));
        Mail::send(new OrderCreated($inp['groupId']));
        return redirect('/orders');
    }

    public function byUser(): View|RedirectResponse
    {
        $user = Cookie::get('user_id');
        $excursions = $this->repository->getExcursions($user);
        return view('orders.order', ['excursions' => $excursions]);
    }
}
