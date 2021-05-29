<?php

namespace App\Http\Controllers;

use App\DataTables\MemberDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateMemberRequest;
use App\Http\Requests\UpdateMemberRequest;
use App\Repositories\MemberRepository;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class MemberController extends AppBaseController
{
    /** @var  MemberRepository */
    private $memberRepository;

    public function __construct(MemberRepository $memberRepo)
    {
        $this->memberRepository = $memberRepo;
    }

    /**
     * Display a listing of the Member.
     *
     * @param MemberDataTable $memberDataTable
     * @return Response
     */
    public function index(MemberDataTable $memberDataTable)
    {
        $recommenders = DB::table('members')->distinct('recommender')->pluck('recommender');
        $names = [];
        foreach($recommenders as $recommender){
            $count = DB::table('members')->where('recommender',$recommender)->count();
            if($count >40){
                $names = Arr::prepend($names,$recommender);
            }

        }
        return $memberDataTable->render('members.index');
    }

    /**
     * Show the form for creating a new Member.
     *
     * @return Response
     */
    public function edit($id)
    {
        $member = $this->memberRepository->find($id);
        return view('agents.create')->with('member',$member);
    }

    /**
     * Store a newly created Member in storage.
     *
     * @param CreateMemberRequest $request
     *
     * @return Response
     */

    /**
     * Display the specified Member.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $member = $this->memberRepository->find($id);

        if (empty($member)) {
            Flash::error('Member not found');

            return redirect(route('members.index'));
        }

        return view('members.show')->with('member', $member);
    }

    /**
     * Show the form for editing the specified Member.
     *
     * @param  int $id
     *
     * @return Response
     */

    /**
     * Update the specified Member in storage.
     *
     * @param  int              $id
     * @param UpdateMemberRequest $request
     *
     * @return Response
     */


    /**
     * Remove the specified Member from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $member = $this->memberRepository->find($id);

        if (empty($member)) {
            Flash::error('Member not found');

            return redirect(route('members.index'));
        }

        $this->memberRepository->delete($id);

        Flash::success('Member deleted successfully.');

        return redirect(route('members.index'));
    }
    //function for recoomending member to the administartor

    public  function hix(){
        $recommenders = DB::table('members')->distinct('recommender')->pluck('recommender');
        $array = "";
        $names = [];
        $check = "fail";
        foreach($recommenders as $recommender){
            $count = DB::table('members')->where('recommender',$recommender)->count();
            if($count >40){
                $check = "ok";
                $names = Arr::prepend($names,$recommender);
                $array = $array." ".$recommender;

            }

        }
        if(Str::is('ok',$check)){
            Flash::success($array." have clocked 40 recommendations");
        }
        return redirect(route('members.index'));
    }

}
