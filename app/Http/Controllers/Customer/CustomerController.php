<?php

namespace App\Http\Controllers\Customer;

use App\Domain\AddressRepositoryInterface;
use App\Domain\Customer;
use App\Domain\CustomerRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerInfoRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    private CustomerRepositoryInterface $infoRepository;
    private AddressRepositoryInterface $addressRepository;

    public function __construct(CustomerRepositoryInterface $infoRepository, AddressRepositoryInterface $addressRepository)
    {
        $this->infoRepository = $infoRepository;
        $this->addressRepository = $addressRepository;
    }

    public function showProfile()
    {
        $address = $this->addressRepository->getByUserId(Auth::id());
        $info = $this->infoRepository->getByCustomerId(Auth::id());
        return view('customer.profile', compact('address'), compact('info'));
    }

    public function create()
    {
        return view('customer.info.create');
    }

    public function store(CustomerInfoRequest $request): RedirectResponse
    {
        $this->infoRepository->save(new Customer(
            $request->email,
            Auth::id(),
            $request->phone,
            $request->additionalContact
        ));

        return redirect()->route('customer_profile');
    }

    public function edit()
    {
        $info = $this->infoRepository->getByCustomerId(Auth::id());
        return view('customer.info.edit', compact('info'));
    }

    public function update(CustomerInfoRequest $request): RedirectResponse
    {
        $info = $this->infoRepository->getByCustomerId(Auth::id());
        $info->update(
            $request->email,
            $request->phone,
            $request->additionalContact
        );

        $this->infoRepository->save($info);

        return redirect()->route('customer_profile');
    }
}
