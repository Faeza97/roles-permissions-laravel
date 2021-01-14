@extends('pdf.layout')

@section('content')
<div class="container">
    <h3> POS Information</h3>
    <div class="div1">
        <table id="main">
            <tr>
                <td><strong>Model: </strong></td>
                <td>

                    @foreach($pos_devices as $pos_device)
                    @if(!empty($requisition->pos_devices_id == $pos_device->id))
                    <input value="{{ $pos_device->model }}">
                    @endif
                    @endforeach

                </td>
                <td><strong>POS S/N: </strong></td>
                <td><input value="{{$pos_device->serial_number}}"></td>
            </tr>
            <tr>
                <td> <strong>Status: </strong> </td>
                <td><input value="{{$pos_device->status}}"></td>
                <td><strong>POS Fastlink Number:</strong></td>
                <td>
                    @foreach($fastlink_numbers as $fastlink_number)
                    @if($requisition->fastlink_numbers_id == $fastlink_number->id)
                    <input value="{{ $fastlink_number->msisdn}}">
                    @endif
                    @endforeach
                </td>
            </tr>
        </table>
    </div>
    <h3> Sales Rep Information</h3>
    <div class="div2">
        <table id="main">
            <tr>
                <td><strong>SR Name:</strong></td>
                <td>
                    @foreach($usersSR as $user)
                    @if($requisition->sales_rep_id == $user->id)
                    <input value="{{$user->name}}">
                    @endif
                    @endforeach
                </td>
                <td><strong>Contact Number:</strong></td>
                <td> @foreach($usersSR as $user)
                    @if($requisition->sales_rep_id == $user->id)
                    <input value="{{$user->mobile_no}}">
                    @endif
                    @endforeach</td>
            </tr>
            <tr>
                <td><strong>City:</strong></td>
                <td>
                    @foreach($usersSR as $user)
                    @if($requisition->sales_rep_id == $user->id)
                    <input value="{{$user->city}}">
                    @endif
                    @endforeach</td>
                <td><strong>Region:</strong></td>
                <td> @foreach($usersSR as $user)
                    @if($requisition->sales_rep_id == $user->id)
                    <input value="{{$user->state}}">
                    @endif
                    @endforeach</td>
            </tr>
        </table>
    </div>
    <h3> Dealer/Merchant Information</h3>
    <div class="div3">
        <table id="main">
            <tr>
                <td><strong>Account Type:</strong></td>
                <td>
                    @foreach($usersDealerMerchant as $user)
                    @if($requisition->dealer_id == $user->id)
                    <input value="{{$user->type}}">
                    @endif
                    @endforeach
                </td>
                <td><strong>Account name:</strong></td>
                <td>
                    @foreach($usersDealerMerchant as $user)
                    @if($requisition->dealer_id == $user->id)
                    <input value="{{$user->name}}">
                    @endif
                    @endforeach
                </td>
            </tr>
            <tr>
                <td><strong>Account Number:</strong></td>
                <td>
                    @foreach($usersDealerMerchant as $user)
                    @if($requisition->dealer_id == $user->id)
                    <input value="{{$user->account_no}}">
                    @endif
                    @endforeach
                </td>
                <td><strong>Shop Name:</strong></td>
                <td>
                    @foreach($usersDealerMerchant as $user)
                    @if($requisition->dealer_id == $user->id)
                    <input value="{{$user->name}}">
                    @endif
                    @endforeach
                </td>
            </tr>
            <tr>
                <td><strong>Shop number:</strong></td>
                <td>
                    @foreach($usersDealerMerchant as $user)
                    @if($requisition->dealer_id == $user->id)
                    <input value="{{$user->mobile_no}}">
                    @endif
                    @endforeach
                </td>
                <td><strong>Location:</td>
                <td> @foreach($usersDealerMerchant as $user)
                    @if($requisition->dealer_id == $user->id)
                    <input value="{{$user->area}} - {{$user->city}} {{$user->state}}">
                    @endif
                    @endforeach</td>
            </tr>
            <tr>
                <td><strong>Doc Name:</strong></td>
                <td><input value=""></td>
                <td><strong>ID Number:</strong></td>
                <td><input value=""></td>
            </tr>
        </table>
    </div>
    <div class="beforeFooter">
        <table id="footerTable1">
            <tr>
                <td>POS Team</td>
                <td> System Admin</td>
                <td>Sales Rep</td>
                <td>Dealer</td>
            </tr>
        </table>
        <table id="footerTable2">
            <tr>
                <td> Name: </td>
                <td> Name: </td>
                <td> Name: </td>
                <td> Signature and Stamp:</td>
            </tr>
        </table>

        <table id="footerTable3">
            <tr>
                <td> Date: </td>
                <td> Date: </td>
                <td> Date: </td>
                <td> Date: </td>
            </tr>
        </table>
    </div>
    <div id="clearance">
        <h2 class="htwoPos">POS Clearance</h2>
        <p class="textP">The POS device which mentioned in this document have already returned to FastPay in proper
            working status
        </p>
    </div>
    <div id="clearanceDivTb">
        <table id="clearanceTb1">
            <tr>
                <td>POS Team</td>
                <td>Dealer</td>
            </tr>
        </table>
        <table id="clearanceTb2">
            <tr>
                <td> Name: </td>
                <td> Signature:</td>
            </tr>
        </table>

        <table id="clearanceTb3">
            <tr>
                <td> Date: </td>
                <td> Date: </td>
            </tr>
        </table>
    </div>
</div>
@endsection




@section('contentPage2')
<div class="container">
<pre><strong>Date:   /   /      </strong></pre>
    <h3 id="h3TitlePage2">Invoice for receiving POS Device</h3>
    <div class="Behalf1st">
        First behalf:- (FastPay) Company, will provide below mentioned points:
        <ul>
            <li>Provide POS Device for seconed behalf.</li>
            <li>Create Account for second behalf.</li>
        </ul>
    </div>

    <div class="Behalf2nd">
        Second behalf:- (Dealer) me as second behalf I proms that I will do points that mentioned below:
        <ul>
            <li>I signed this papeer that I acknowledge (POS Device) from his owner (Fastpay) company and the device is
                working properly without any issue.</li>
            <li>I proms that I use this device only for purpose of (selling cash, refill user accounts, resend cash for
                users depend in users request).</li>
            <li>I don't have permission to use device to any other purpose and I don't have permission to open device or
                change operating system.</li>
            <li>I proms that I will be responsible for device and I will be only user or caretaker of the device, I
                don't habe permission to rent the device ot sell it or any other actions without inform company, and I
                proms that I use it only at shop at work time.</li>
            <li>I proms that I will sell cards, services, and other items with its formal price, I will not take any
                extra money from users.</li>
            <li>I proms that I will protect device from being damage or lost, and I will do anything to protect device
                from getting lost or stealing...</li>
            <li>I proms that I return the device any time that company has request otherwise I am ready to pay 200$ for
                company</li>
        </ul>
    </div>
    <div class="signatureP2">
        <table id="signatureP2">
            <tr>
                <td><strong>Signature:</strong></td>
            </tr>
            <tr>
                <td><strong>Full name:</strong></td>
            </tr>
            <tr>
                <td><strong>Phone number:</strong></td>
            </tr>
            <tr>
                <td><strong>Email:</strong></td>
            </tr>
            <tr>
                <td><strong>Work Location:</strong></td>
            </tr>
            <tr>
                <td><strong>Home Location:</strong></td>
            </tr>
            <tr>
                <td><strong>Location of Usin device:</strong></td>
            </tr>
            <tr>
                <td><strong>ID Card number:</strong></td>
            </tr>
            <tr>
                <td><strong>Passport number:</strong></td>
            </tr>
        </table>
    </div>
</div>
@endsection
