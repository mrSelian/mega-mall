<?php

namespace App\Http\Controllers\Customer;

use App\Domain\AddressRepositoryInterface;
use App\Domain\CustomerInfoRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerInfoRequest;
use App\Models\CustomerInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InfoController extends Controller
{
    private CustomerInfoRepositoryInterface $infoRepository;
    private AddressRepositoryInterface $addressRepository;

    public function __construct(CustomerInfoRepositoryInterface $infoRepository, AddressRepositoryInterface $addressRepository)
    {
        $this->infoRepository = $infoRepository;
        $this->addressRepository = $addressRepository;
    }

    public function customerProfile()
    {
        $address = $this->addressRepository->getByUserId(Auth::id());
        $info = $this->infoRepository->getByCustomerId(Auth::id());
        return view('customer.profile', compact('address'),compact('info'));
    }

    public function create()
    {
        return view('customer.info.create');
    }

    public function store(CustomerInfoRequest $request)
    {
        $request->user()->customerInfo()->create($request->all());

        return redirect(route('customer_profile'));
    }

    public function edit(Request $request)
    {
        $info = $this->infoRepository->getByCustomerId(Auth::id());
        return view('customer.info.edit', compact('info'));
    }

    public function update(CustomerInfoRequest $request)
    {
        $info = $this->infoRepository->getByCustomerId(Auth::id());
        $info->phone = $request->get('phone');
        $info->email = $request->get('email');
        $info->additional_contact = $request->get('additional_contact');
        $this->infoRepository->save($info);

        return redirect(route('customer_profile'));
    }
}
