@extends('layouts.app')

@section('title', 'Edit Order')

@section('content')
<div class="container">
    <h1>Edit Order</h1>

    <form action="{{ route('orders.update', $order->order_no) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="customer_name" class="form-label">Customer Name</label>
            <input type="text" name="customer_name" id="customer_name" class="form-control" value="{{ old('customer_name', $order->customer_name) }}" required>
        </div>

        <div class="mb-3">
            <label for="installation_date" class="form-label">Installation Date</label>
            <input type="date" name="installation_date" id="installation_date" class="form-control" value="{{ old('installation_date', $order->installation_date) }}" required>
        </div>

        <div class="mb-3">
            <label for="exchange" class="form-label">Exchange</label>
            <input type="text" name="exchange" id="exchange" class="form-control" value="{{ old('exchange', $order->exchange) }}" required>
        </div>

        <div class="mb-3">
            <label for="work_activity" class="form-label">Work Activity</label>
            <select type="work_activity" name="work_activity" id="work_activity" class="form-control" value="{{ old('work_activity', $order->work_activity) }}" required>
                <option value="HSBB - FTTH(OH) & H/RISE" {{ $order->work_activity == 'HSBB - FTTH(OH) & H/RISE' ? 'selected' : '' }}>HSBB - FTTH(OH) & H/RISE</option>
                <option value="HSBB - FTTH(UG)" {{ $order->work_activity == 'HSBB - FTTH(UG)' ? 'selected' : '' }}>HSBB - FTTH(UG)</option>
                <option value="HSBB - UNIFI VDSL" {{ $order->work_activity == 'HSBB - UNIFI VDSL' ? 'selected' : '' }}>HSBB - UNIFI VDSL</option>
                <option value="HSBB - MODIFY ORDER" {{ $order->work_activity == 'HSBB - MODIFY ORDER' ? 'selected' : '' }}>HSBB - MODIFY ORDER</option>
                <option value="HSBA - FTTH(OH) & H/RISE" {{ $order->work_activity == 'HSBA - FTTH(OH) & H/RISE' ? 'selected' : '' }}>HSBA - FTTH(OH) & H/RISE</option>
                <option value="HSBA - FTTH(UG)" {{ $order->work_activity == 'HSBA - FTTH(UG)' ? 'selected' : '' }}>HSBA - FTTH(UG)</option>
                <option value="HSBA - UNIFI VDSL" {{ $order->work_activity == 'HSBA - UNIFI VDSL' ? 'selected' : '' }}>HSBA - UNIFI VDSL</option>
                <option value="FTTH(OH) HR UG(ACCESS SEEKER)" {{ $order->work_activity == 'FTTH(OH) HR UG(ACCESS SEEKER)' ? 'selected' : '' }}>FTTH(OH) HR UG(ACCESS SEEKER)</option>
                <option value="FTTH(OH) HR UG(SHARED BTU ODR)" {{ $order->work_activity == 'FTTH(OH) HR UG(SHARED BTU ODR)' ? 'selected' : '' }}>FTTH(OH) HR UG(SHARED BTU ODR)</option>
                <option value="CTT" {{ $order->work_activity == 'CTT' ? 'selected' : '' }}>CTT</option>
                <option value="SEM:INSTL UI WITH COMBO BOX OH & HR" {{ $order->work_activity == 'SEM:INSTL UI WITH COMBO BOX OH & HR' ? 'selected' : '' }}>SEM:INSTL UI WITH COMBO BOX OH & HR</option>
                <option value="SEM:INSTL UI WITH COMBO BOX UG" {{ $order->work_activity == 'SEM:INSTL UI WITH COMBO BOX UG' ? 'selected' : '' }}>SEM:INSTL UI WITH COMBO BOX UG</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="id_slot_order" class="form-label">ID Slot Order</label>
            <select type="id_slot_order" name="id_slot_order" id="id_slot_order" class="form-control" value="{{ old('id_slot_order', $order->id_slot_order) }}" required>
                <option value="Q100019 MOHAMAD RAZIFF BIN MAJID" {{ $order->id_slot_order == 'Q100019 MOHAMAD RAZIFF BIN MAJID' ? 'selected' : '' }}>Q100019 MOHAMAD RAZIFF BIN MAJID</option>
                <option value="Q105340 MOHD RAHIMI BIN MOHD RHAZI" {{ $order->id_slot_order == 'Q105340 MOHD RAHIMI BIN MOHD RHAZI' ? 'selected' : '' }}>Q105340 MOHD RAHIMI BIN MOHD RHAZI</option>
                <option value="Q106147 MOHD FIRDAUS BIN MOHD NOR" {{ $order->id_slot_order == 'Q106147 MOHD FIRDAUS BIN MOHD NOR' ? 'selected' : '' }}>Q106147 MOHD FIRDAUS BIN MOHD NOR</option>
                <option value="Q109282 MUHAMMAD RIFQI DANISH BIN ROSLAN" {{ $order->id_slot_order == 'Q109282 MUHAMMAD RIFQI DANISH BIN ROSLAN' ? 'selected' : '' }}>Q109282 MUHAMMAD RIFQI DANISH BIN ROSLAN</option>
                <option value="Q107649 MUHAMMAD FAIZ BIN ABDULLAH" {{ $order->id_slot_order == 'Q107649 MUHAMMAD FAIZ BIN ABDULLAH' ? 'selected' : '' }}>Q107649 MUHAMMAD FAIZ BIN ABDULLAH</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="team_leader" class="form-label">Team Leader Pasang</label>
            <select type="team_leader" name="team_leader" id="team_leader" class="form-control" value="{{ old('team_leader', $order->team_leader) }}" required>
                <option value="AJIS" {{ $order->team_leader == 'AJIS' ? 'selected' : '' }}>AJIS</option>
                <option value="AZRUL" {{ $order->team_leader == 'AZRUL' ? 'selected' : '' }}>AZRUL</option>
                <option value="DANISH" {{ $order->team_leader == 'DANISH' ? 'selected' : '' }}>DANISH</option>
                <option value="FIRDAUS" {{ $order->team_leader == 'FIRDAUS' ? 'selected' : '' }}>FIRDAUS</option>
                <option value="KADIAQ" {{ $order->team_leader == 'KADIAQ' ? 'selected' : '' }}>KADIAQ</option>
                <option value="RAHIMI" {{ $order->team_leader == 'RAHIMI' ? 'selected' : '' }}>RAHIMI</option>
                <option value="SHARIL" {{ $order->team_leader == 'SHARIL' ? 'selected' : '' }}>SHARIL</option>
                <option value="SINOR ADMIN" {{ $order->team_leader == 'SINOR ADMIN' ? 'selected' : '' }}>SINOR ADMIN</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="team_member_1" class="form-label">Team Member Pasang</label>
            <select type="team_member_1" name="team_member_1" id="team_member_1" class="form-control" value="{{ old('team_member_1', $order->team_member_1) }}" required>
                <option value="TIADA - JALAN 1 ORG SHJ" {{ $order->team_member_1 == 'TIADA - JALAN 1 ORG SHJ' ? 'selected' : '' }}>TIADA - JALAN 1 ORG SHJ</option>
                <option value="AJIS" {{ $order->team_member_1 == 'AJIS' ? 'selected' : '' }}>AJIS</option>
                <option value="AZRUL" {{ $order->team_member_1 == 'AZRUL' ? 'selected' : '' }}>AZRUL</option>
                <option value="DANISH" {{ $order->team_member_1 == 'DANISH' ? 'selected' : '' }}>DANISH</option>
                <option value="FIRDAUS" {{ $order->team_member_1 == 'FIRDAUS' ? 'selected' : '' }}>FIRDAUS</option>
                <option value="KADIAQ" {{ $order->team_member_1 == 'KADIAQ' ? 'selected' : '' }}>KADIAQ</option>
                <option value="RAHIMI" {{ $order->team_member_1 == 'RAHIMI' ? 'selected' : '' }}>RAHIMI</option>
                <option value="SHARIL" {{ $order->team_member_1 == 'SHARIL' ? 'selected' : '' }}>SHARIL</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="team_member_2" class="form-label">Team Member Kedua Pasang</label>
            <select type="team_member_2" name="team_member_2" id="team_member_2" class="form-control" value="{{ old('team_member_2', $order->team_member_2) }}" required>
                <option value="TIADA - JALAN 1 ORG SHJ" {{ $order->team_member_1 == 'TIADA - JALAN 1 ORG SHJ' ? 'selected' : '' }}>TIADA - JALAN 1 ORG SHJ</option>
                <option value="TIADA - JALAN 2 ORG SHJ" {{ $order->team_member_1 == 'TIADA - JALAN 2 ORG SHJ' ? 'selected' : '' }}>TIADA - JALAN 2 ORG SHJ</option>
                <option value="AJIS" {{ $order->team_member_2 == 'AJIS' ? 'selected' : '' }}>AJIS</option>
                <option value="AZRUL" {{ $order->team_member_2 == 'AZRUL' ? 'selected' : '' }}>AZRUL</option>
                <option value="DANISH" {{ $order->team_member_2 == 'DANISH' ? 'selected' : '' }}>DANISH</option>
                <option value="FIRDAUS" {{ $order->team_member_2 == 'FIRDAUS' ? 'selected' : '' }}>FIRDAUS</option>
                <option value="KADIAQ" {{ $order->team_member_2 == 'KADIAQ' ? 'selected' : '' }}>KADIAQ</option>
                <option value="RAHIMI" {{ $order->team_member_2 == 'RAHIMI' ? 'selected' : '' }}>RAHIMI</option>
                <option value="SHARIL" {{ $order->team_member_2 == 'SHARIL' ? 'selected' : '' }}>SHARIL</option>
            </select>
        </div>
        
        <div class="mb-3">
            <label for="team_member_3" class="form-label">Team Member Ketiga Pasang</label>
            <select type="team_member_3" name="team_member_3" id="team_member_3" class="form-control" value="{{ old('team_member_2', $order->team_member_2) }}" required>
                <option value="TIADA - JALAN 1 ORG SHJ" {{ $order->team_member_3 == 'TIADA - JALAN 1 ORG SHJ' ? 'selected' : '' }}>TIADA - JALAN 1 ORG SHJ</option>
                <option value="TIADA - JALAN 2 ORG SHJ" {{ $order->team_member_3 == 'TIADA - JALAN 2 ORG SHJ' ? 'selected' : '' }}>TIADA - JALAN 2 ORG SHJ</option>
                <option value="TIADA - JALAN 3 ORG SHJ" {{ $order->team_member_3 == 'TIADA - JALAN 3 ORG SHJ' ? 'selected' : '' }}>TIADA - JALAN 3 ORG SHJ</option>
                <option value="AJIS" {{ $order->team_member_3 == 'AJIS' ? 'selected' : '' }}>AJIS</option>
                <option value="AZRUL" {{ $order->team_member_3 == 'AZRUL' ? 'selected' : '' }}>AZRUL</option>
                <option value="DANISH" {{ $order->team_member_3 == 'DANISH' ? 'selected' : '' }}>DANISH</option>
                <option value="FIRDAUS" {{ $order->team_member_3 == 'FIRDAUS' ? 'selected' : '' }}>FIRDAUS</option>
                <option value="KADIAQ" {{ $order->team_member_3 == 'KADIAQ' ? 'selected' : '' }}>KADIAQ</option>
                <option value="RAHIMI" {{ $order->team_member_3 == 'RAHIMI' ? 'selected' : '' }}>RAHIMI</option>
                <option value="SHARIL" {{ $order->team_member_3 == 'SHARIL' ? 'selected' : '' }}>SHARIL</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-control">
                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Update Order</button>
        <a href="{{ route('orders.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
