<?php

use App\Http\Controllers\GroupController;
use App\Http\Controllers\superadmin\CompanyAjaxController;
use App\Http\Controllers\Admin\SupplierController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CcgFeedController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\RfqController;
use App\Http\Controllers\Admin\InviteteamController;
use App\Http\Controllers\superadmin\superadminController;
use App\Http\Controllers\superadmin\CompanyController;
use App\Http\Controllers\superadmin\JobsRoleController;
use App\Http\Controllers\superadmin\ClaimRequestCompanyController;
use App\Http\Controllers\superadmin\RejectedCompanyController;
use App\Http\Controllers\superadmin\NewRequestCompanyController;
use App\Http\Controllers\superadmin\CategoryController;
use App\Http\Controllers\superadmin\CompanyDocumentManagerController;
use App\Http\Controllers\superadmin\CoverLetterController;
use App\Http\Controllers\superadmin\NDAControlller;
use App\Http\Controllers\superadmin\ContractController;
use App\Http\Controllers\superadmin\BidSheetController;
use App\Http\Controllers\Admin\GuestController;
use App\Http\Controllers\Admin\CompanyProfileController;
use App\Http\Controllers\Admin\LikeController;
use App\Http\Controllers\Admin\UserProfileController;
use App\Http\Controllers\Admin\RfqDraftController;
use App\Http\Controllers\Admin\RfqReceivedController;
use App\Http\Controllers\Admin\SupplierGroupController;
use App\Http\Controllers\Admin\NewsFeedController;
use App\Http\Controllers\Admin\AdminAjaxController;
use App\Http\Controllers\superadmin\CompanyEditController;
use App\Http\Controllers\superadmin\PlanController;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SubscriptionController;
use App\Http\Controllers\StripeWebhookController;
use App\Models\Conversation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('clear',function(){
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
});
Route::get('storage:link', function () {
    Artisan::call('storage:link');
});
Route::get('invite-mail/team/{validToken}', [GuestController::class, 'getInviteMember'])->name('getting.invitesMembers');

Route::any('/payment_gateway_callback', [StripeWebhookController::class, 'handleWebhook']);
// Auth  
Route::controller(AuthController::class)->group(function () {
    Route::get('/', 'ClaimYourCompany')->name('auth.claim_your_company');
    Route::get('/claim-payment-list/{id}', 'ClaimPayment')->name('auth.ClaimPayment');
    Route::post('/claim-payment-free-add', 'ClaimPaymentFree')->name('auth.ClaimPaymentFree');
    Route::get('/claim-payment', 'claimPaymentList')->name('auth.claimPaymentList');
    Route::get('/claim-request/{id}', 'claim_request')->name('auth.claim_request');
    Route::get('/sign_up', 'CreateAccountUser')->name('auth.sign_up');
    Route::get('/company_search', 'CompanySearch')->name('auth.company_search');
    Route::get('/searchState', 'SearchState')->name('auth.SearchState');
    Route::get('/SearchCity', 'SearchCity')->name('auth.SearchCity');
    Route::get('/getStateCity', 'getStateCity')->name('auth.getStateCity');
    Route::post('/checkotp', 'checkotp')->name('auth.checkotp');
    Route::get('/email-verification', 'EmailVerification')->name('auth.email_verification');
    Route::post('/sign_in', 'CreateAccountUser')->name('auth.sign_in');

    Route::post('/invite_member', 'CreateAccountUserWithToken')->name('auth.sign_in.invite-member');
    Route::post('/company_add', 'CompanyAdd')->name('auth.company_add');
    Route::post('/CreateAccount', 'CreateAccount')->name('auth.CreateAccount');
    Route::post('/loginAdd', 'login')->name('auth.login');
    Route::get('/login', 'loginShow')->name('auth.loginShow');
    Route::get('/verify-login', 'loginMemberShow')->name('member.auth.loginShow');
    Route::get('/claim-profile-company', 'ClaimProfileCompany')->name('auth.ClaimProfileCompany');

    Route::Any('/create-an-account/{company_id}', 'CreateAnAccount')->name('auth.create_an_account');

    Route::get('/company_document_page/{company_id}/{user_id}', 'CompanyDocumentPage')->name('auth.company_document_page');
    Route::post('/company_document_add', 'CompanyDocumentAdd')->name('auth.company_document_add');
    Route::get('/claim-list', 'ListYourCompany')->name('auth.list_your_company');
    Route::get('/getStateCity', 'getStateCity')->name('auth.getStateCity');
    Route::get('/thank_you', 'verificationSMS')->name('auth.verificationSMS');


    Route::get('superadmin-login', 'SuperLogin')->name('superadmin.login');
    Route::post('SuperAdminlogin', 'SuperAdminlogin')->name('superadmin.SuperAdminlogin');

    Route::get('/optverifytoken/{company_id}/{user_id}', 'EmailOtpVerification')->name('opt.verify');
     Route::Any('/resendotp/{company_id}/{user_id}', 'Resendotp')->name('opt.Resendotp');
    Route::post('/optverifytoken/checkotp/{company_id}/{user_id}', 'byMailcheckotp')->name('mail.checkotp');
});
// Admin
Route::middleware('auth:web')->prefix('admin')->group(function () {
        Route::controller(AdminController::class)->group(function () {
            Route::get('dashboard', 'dashboard')->name('admin.dashboard');
            Route::get('purchase/subscription/plan/{plan_id}', 'purchaseSubscriptionPlan')->name('admin.purchaseSubscriptionPlan');
            Route::post('purchase/subscription/plan/geteway', 'purchaseSubscriptionPlanGateway')->name('admin.purchaseSubscriptionPlanGateway');
            Route::get('purchase/success', 'success')->name('admin.success');
            Route::get('purchase/canceled', 'canceled')->name('admin.canceled');
            Route::post('/admin_logout', 'admin_logout')->name('admin.admin_logout');
            Route::post('/subscription_plan', 'subscriptionPlan')->name('admin.subscriptionPlan');
        });
    Route::get('subscription/index', [SubscriptionController::class, 'index'])->name('subscription.index');
    Route::post('subscription/paymentUpdate', [SubscriptionController::class, 'paymentUpdate'])->name('subscription.paymentUpdate');
    Route::group(['middleware' => 'role:RFQ Events'], function () {
        // RFQ
        Route::resource('RFQ', RfqController::class);
        Route::get('autocomplete/bidcurrency', [RfqController::class, 'bidCurrencySearch'])->name('autocomplete.bidcurrency');
        Route::get('sent/index', [RfqController::class, 'sentIndex'])->name('RFQ.sentIndex');
        Route::get('received/index', [RfqController::class, 'ReceivedIndex'])->name('RFQ.ReceivedIndex');   
    
    });
        // get single message and group
        Route::get('get/group/{group}', [GroupController::class, 'getGroup'])->name('group.view');
        Route::get('get/conversation/{conversation}', [ConversationController::class, 'getMessage'])->name('conversation.index');
        //get rfq group
        Route::get('get/rfq-chat-groups/{id}', [GroupController::class, 'getRfqGroups'])->name('rfq.group.view');
        Route::group(['middleware' => 'role:Messages'], function () {
          Route::get('messages', [GroupController::class, 'index'])->name('RFQ.messages.all');
        });
        // search suplliers
        Route::get('suppliers', [SupplierController::class, 'getAll'])->name('search.supplier');
        Route::get('supplier/individual-chat/{id}', [ConversationController::class, 'getChat']);
        Route::get('getMemberRoles', [RfqController::class, 'getMemberRoles'])->name('RFQ.getMemberRoles');
        // nda remove
        Route::get('nda_remove', [RfqController::class, 'nda_remove'])->name('nda.nda_remove.delete');
        Route::get('contractRmove', [RfqController::class, 'contractRmove'])->name('nda.contractRmove.delete');
        Route::get('bidsheet_remove', [RfqController::class, 'bidsheet_remove'])->name('nda.bidsheet_remove.delete');
        Route::get('location_remove', [RfqController::class, 'location_remove'])->name('nda.location_remove.delete');
        Route::get('adddelete_company', [RfqController::class, 'adddelete_company'])->name('nda.adddelete_company.delete');
        // create group for chat
        Route::get('RFQs/create-message-group/{rfqDetail}', [RfqController::class, 'createRfqMessageGroup'])->name('createRfqMessageGroup');
        // message group chat route
        Route::get('chat/groups/{group}/{offset?}', [ConversationController::class, 'loadChat']);
        Route::post('chat/group', [ConversationController::class, 'store'])->name('group.chat.send');
        Route::get('chat/delete/{conversation}', [ConversationController::class, 'destroy'])->name('conversation.delete');
        
        Route::get('indiviual/index/{id}', [RfqController::class, 'individualIndex'])->name('RFQ.individualIndex');
        Route::get('received-indiviual-index/{id}', [RfqController::class, 'individualReceived'])->name('RFQ.individualReceived');
        Route::post('rfq/send/{id}', [RfqController::class, 'rfqsend'])->name('RFQ.rfqsend');
        Route::post('rfq/ndasing/{id}/{type}', [RfqController::class, 'NDASing'])->name('RFQ.NDASing');
        Route::post('rfq/comment-accepted/{rfqdetail_id}/{category_id}/{supplier_id}', [RfqController::class, 'commentAccepted'])->name('RFQ.commentAccepted');
    
    
        Route::get('select-sub-category', [RfqController::class, 'SelectSubCategory'])->name('admin.SelectSubCategory');
        Route::get('select-cover-img', [RfqController::class, 'SelectCoverImg'])->name('admin.SelectCoverImg');
        Route::get('SelectCompanys', [RfqController::class, 'SelectCompanys'])->name('admin.SelectCompanys');
        Route::Any('/rfq-suppler-group-select', [RfqController::class, 'rfqSupplerGroup'])->name('admin.rfqSupplerGroup');
        // productandservice get response
        Route::get('productAndServices', [RfqController::class, 'productAndServices'])->name('product.and.service');
    
         // inivite member
        Route::group(['middleware' => 'role:User'], function () {
            Route::get('invites-members', [InviteteamController::class, 'index'])->name('invites-members.create');
            Route::get('invites-members-user-profile/edit/{id}', [InviteteamController::class, 'editByAdminUserProfile'])->name('invites-members.admin.edit');
            Route::post('invites-members-user-profile-update/{id}', [InviteteamController::class, 'updateByAdminUserProfile'])->name('invites-members.admin.update');
            Route::get('invites-members', [InviteteamController::class, 'index'])->name('invites-members.create');
            Route::post('invites-members/sendinvites', [InviteteamController::class, 'invitesMembers'])->name('invites-members.invitesMembers');
            Route::get('invites-members/edit/{id}', [InviteteamController::class, 'editInvitesMembers'])->name('invites.edit');
            Route::post('invites-members/update/{id}', [InviteteamController::class, 'update'])->name('invites.update');
            Route::post('invites-members/delete/{id}', [InviteteamController::class, 'deleteInvitesMembers'])->name('invites.delete');
        });
        
        Route::group(['middleware' => 'role:Company'], function () {
            // Role
            Route::get('role/create', [RoleController::class, 'create'])->name('role.create');
            Route::get('role/edit/{id}', [RoleController::class, 'edit'])->name('role.edit');
            Route::get('role/index', [RoleController::class, 'index'])->name('role.index');
            Route::post('role/store', [RoleController::class, 'store'])->name('role.store');
            Route::post('role/update/{id}', [RoleController::class, 'update'])->name('role.update');
        });
        
        //company profile
        Route::group(['middleware' => 'role:Company'], function () {
            Route::get('company-view-profile', [CompanyProfileController::class, 'profileView'])->name('company.profile');
            Route::get('company-profile', [CompanyProfileController::class, 'index'])->name('admin.company.profile');
            Route::get('company-select-sub-category', [CompanyProfileController::class, 'companyProfileSelectSubCategory'])->name('company.SelectSubCategory');
            Route::post('company-profile/store', [CompanyProfileController::class, 'companyProfileStore'])->name('company.profile.create');
            Route::get('company-select-sub-category', [CompanyProfileController::class, 'companyProfileSelectSubCategory'])->name('company.SelectSubCategory');
            Route::get('/getsubcategory', [CompanyProfileController::class, 'getSubcategory'])->name('company.getsubcategory');
        
            //company profile
            Route::post('del-company-view-profile/{id}', [CompanyProfileController::class, 'delelteProduct'])->name('product.delete');
            //delete company brand logo
            Route::post('company-profile/del-company-brnad-logo/{id}', [CompanyProfileController::class, 'delelteCompanyProfileBrandLogo'])->name('brnad.logo.delete');
            //delete company  logo
            Route::post('del-company-logo/{id}', [CompanyProfileController::class, 'delelteCompanyLogo'])->name('company.logo.delete');
            //delete company  location
            Route::post('del-company-location/{id}', [CompanyProfileController::class, 'delelteCompanyLocation'])->name('company_location.delete');
            //delete company  profile Info
            Route::post('del-company-contact-info/{id}', [CompanyProfileController::class, 'delelteCompanyContactInfo'])->name('company_conatct.delete');
            //delete orginational structure 
            Route::post('del-organisational-structre/{id}', [CompanyProfileController::class, 'delelteOrganisationalStructer'])->name('organisational_structre.delete');
            //delete product catelog 
            Route::post('del-product-catelog/{id}', [CompanyProfileController::class, 'delelteProductCatelog'])->name('product_catelog.delete');
            //delete Company Brochure 
            Route::post('del-company-brochure/{id}', [CompanyProfileController::class, 'delelteCompanyBrochure'])->name('company.brochure.delete');
            //delete Company Brochure 
            Route::post('del-customer-client/{id}', [CompanyProfileController::class, 'delelteCustomerClient'])->name('customer.client.delete');
             Route::post('del-company_primary/{id}', [CompanyProfileController::class, 'companyPrimary'])->name('customer.company_primary.delete');
            //delete Company financial 
            Route::post('del-company-financial-image/{id}', [CompanyProfileController::class, 'delelteCompanyFinancialImage'])->name('company.financialimage.delete');
        });
        // user profile
        Route::get('user/profile', [UserProfileController::class, 'index'])->name('user.profile');
        Route::post('update-user/profile/{id}', [UserProfileController::class, 'updateUserProfile'])->name('update.user.profile');
        Route::get('view-user/profile/', [UserProfileController::class, 'viewUserProfile'])->name('view.user.profile');
      
    
      	//Route::resource('suppliergroups', SupplierGroupController::class);
        Route::get('/search-team-member', [AdminAjaxController::class, 'search_team_member'])->name('admin.search.team.members');
        Route::get('/search-companies', [AdminAjaxController::class, 'search_company'])->name('admin.search.companies');
        Route::post('/admin/validate/group', [AdminAjaxController::class, 'validateGroup'])->name('admin.validate.group');
        Route::post('/admin/validate/team-group', [AdminAjaxController::class, 'validateSupplierTeam'])->name('admin.validate.supplier.group');
        Route::post('/supplier-info', [AdminAjaxController::class, 'supplier_info'])->name('company.supplier.info');
        Route::delete('/delete-supplier-team-member/{id}', [AdminAjaxController::class,'deleteSupplierTeamMember'])->name('delete.supplier.team.member');
        Route::post('/buyer-info', [AdminAjaxController::class, 'buyer_info'])->name('company.buyer.info');
        Route::get('/company-collaborative-group/{id}/questionnaires', [CcgFeedController::class, 'fetchQuestionnaires'])->name('feed.questionnaires');
        Route::get('/questionnaire/{questionnaire}/submit-response', [CcgFeedController::class, 'getQuestionnaire'])->name('feed.questionnaire.view');
        Route::post('/questionnaire/{questionnaire}/submit-response', [CcgFeedController::class, 'submitQuestionnaireResponse'])->name('feed.submit-questionnaire');
        Route::post('/save-group-inf', [AdminAjaxController::class, 'save_group_info'])->name('save.buyer.group.info');
        Route::delete('/delete-buyer-team-member/{id}', [AdminAjaxController::class,'deleteBuyerTeamMember'])->name('delete.buyer.team.member');
        Route::delete('/delete-supplier', [AdminAjaxController::class,'deleteSupplier'])->name('delete.buyer.supplier');
    
    Route::group(['middleware' => 'role:Collaborators'], function () {
        Route::get('create-buyer-group', [SupplierController::class, 'index'])->name('admin.create.group');
        Route::post('save-group', [SupplierController::class, 'store'])->name('admin.save.group');
        Route::post('save/supplier/team/{id}', [SupplierController::class, 'storeSupplierTeam'])->name('admin.save.supplier.team');
        Route::get('supplier', [SupplierController::class, 'suppliers'])->name('admin.supplier');
        Route::get('supplier-reject/{id}', [SupplierController::class, 'supplierReject'])->name('admin.group.supplier.reject');
        Route::post('update-buyer-group/{id?}', [SupplierController::class, 'updateBuyerGroup'])->name('admin.group.buyer.update');
    });
        // news feed routes
        Route::prefix('collab-news-feed')->controller(CcgFeedController::class)->name('admin.news-feed.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
        });
    
        Route::prefix('group-feed')->controller(CcgFeedController::class)->name('admin.group-feed.')->group(function (){
            Route::get('/', 'groupFeeds')->name('index');
            Route::get('/delete/{ccgFeed}', 'destroy')->name('delete');
        });
    
        Route::prefix('comment')->controller(CommentController::class)->name('admin.comment.')->group(function () {
            Route::get('/{CcgFeed}', 'index')->name('index');
            Route::post('/store', 'store')->name('store');
            Route::get('/delete/{comment}', 'destroy')->name('delete');
        });
        
        // Group Supplier
    Route::group(['middleware' => 'role:Supplier Group'], function () {
        Route::get('supplier-group', [SupplierGroupController::class, 'index'])->name('admin.supplier.group');
        Route::get('supplier-group/create', [SupplierGroupController::class, 'create'])->name('admin.supplier.group.create');
        Route::post('save-supplier-group', [SupplierGroupController::class, 'store'])->name('admin.save.supplier.group');
        Route::post('save/supplier/team/{id}', [SupplierGroupController::class, 'storeSupplierTeam'])->name('admin.save.supplier.team');
        Route::get('supplier', [SupplierGroupController::class, 'suppliers'])->name('admin.supplier');
        Route::get('supplier-reject/{id}', [SupplierGroupController::class, 'supplierReject'])->name('admin.group.supplier.reject');
        Route::post('update-buyer-group/{id?}', [SupplierGroupController::class, 'updateBuyerGroup'])->name('admin.group.buyer.update');
        Route::get('supplier-exit/{id}', [SupplierGroupController::class, 'supplierReject'])->name('admin.supplier.exit');
    
        Route::post('/save-group-inf-supplier', [SupplierGroupController::class, 'save_group_infoSupplier'])->name('save.save_group_infoSupplier');
        Route::post('/deleteSupplierTeamMember_Supplier', [SupplierGroupController::class, 'deleteSupplierTeamMember_Supplier'])->name('save.deleteSupplierTeamMember_Supplier');
        Route::Any('/buyer_info_Supplier', [SupplierGroupController::class, 'buyer_info_Supplier'])->name('save.buyer_info_Supplier');
      	Route::Any('/company-profile-show/{id}', [SupplierGroupController::class, 'companyProfileShow'])->name('company.profile.show');
      	Route::Any('/view-product-catelog', [SupplierGroupController::class, 'viewProductCatelog'])->name('company.profile.view_product_catelog');
        Route::Any('/company-profile-delete', [SupplierGroupController::class, 'companyProfileDelete'])->name('company.profile.delete');
        Route::Any('/supplier-group-company-add-', [SupplierGroupController::class, 'supplierGroupCompanyAdd'])->name('supplier.group.company_add');
    });
    
        Route::post('/like', [LikeController::class, 'addLike'])->name('admin.like');
        
        // newsfeed
        Route::group(['middleware' => 'role:Newfeed'], function () {
            Route::Any('/news-feed', [NewsFeedController::class, 'index'])->name('newsfeed.index');
            Route::Any('/news-feed-post', [NewsFeedController::class, 'post'])->name('newsfeed.post');
            Route::Any('/news-feed-add', [NewsFeedController::class, 'store'])->name('newsfeed.store');
            Route::Any('company/follow/{follow_id}', [NewsFeedController::class, 'following'])->name('newsfeed.following');
            Route::Any('company/like', [NewsFeedController::class, 'feedLike'])->name('newsfeed.feedLike');
            Route::Any('company/comment/feed', [NewsFeedController::class, 'foodCommentSubmit'])->name('newsfeed.foodCommentSubmit');
            Route::Any('company/comment/get/feed', [NewsFeedController::class, 'foodCommentGet'])->name('newsfeed.foodCommentGet');
            Route::Any('company/comment/like', [NewsFeedController::class, 'commentLike'])->name('newsfeed.commentLike');
            Route::Any('company/comment/reply', [NewsFeedController::class, 'CommentReplySubmit'])->name('newsfeed.CommentReplySubmit');
            Route::Any('company/comment/reply/get', [NewsFeedController::class, 'CommentReplyGet'])->name('newsfeed.CommentReplyGet');
        });
    
        Route::prefix('group-feed')->controller(CcgFeedController::class)->name('admin.group-feed.')->group(function (){
            Route::get('/', 'groupFeeds')->name('index');
        });
    
        Route::prefix('comment')->controller(CommentController::class)->name('admin.comment.')->group(function () {
            Route::get('/{CcgFeed}', 'index')->name('index');
            Route::post('/store', 'store')->name('store');
            Route::post('/like', [LikeController::class, 'addLike'])->name('admin.like');
    
        });
});
// superadmin
Route::middleware('auth:superadmin')->prefix('superadmin')->group(function () {
    // plans
    Route::get('plans', [PlanController::class, 'index'])->name('paymant.plans.index');
    Route::get('plans/create', [PlanController::class, 'create'])->name('paymant.plans.create');
    Route::get('plans/edit/{id}', [PlanController::class, 'edit'])->name('paymant.plans.edit');
    Route::post('plans/store', [PlanController::class, 'store'])->name('paymant.plans.store');
    Route::post('plans/update/{id}', [PlanController::class, 'update'])->name('paymant.plans.update');
    // dashboard
    Route::controller(superadminController::class)->group(function () {
        Route::get('dashboard', 'SuperAdminDashboad')->name('superadmin.dashboard');
        Route::post('SuperAdminlogout', 'SuperAdminlogout')->name('superadmin.SuperAdminlogout');

        Route::resource('company', CompanyController::class);

        Route::get('company/edit/{id}', [CompanyController::class, 'edit'])->name('company.edit');
        Route::get('claimed_status/{id}', [CompanyController::class, 'claimed_status'])->name('company.claimed_status');
        Route::get('companyType', [CompanyController::class, 'companyType'])->name('company.companyType');
        Route::get('create-company-type', [CompanyController::class, 'createCompanyType'])->name('create.company.type');
        Route::post('create-company-type/store', [CompanyController::class, 'storeCompanyType'])->name('store.company.type');
        Route::get('edit-company-type/{id}', [CompanyController::class, 'editCompanyType'])->name('company.type.edit');
        Route::post('update-company-type/{id}', [CompanyController::class, 'updateCompanyType'])->name('update.company.type');
        Route::post('delete-company-type/{id}', [CompanyController::class, 'deleteCompanyType'])->name('delete.company.type');
        Route::get('status/{id}', [CompanyController::class, 'status'])->name('company.status');
        Route::get('Approved_Status/{id}', [CompanyController::class, 'Approved_Status'])->name('company.Approved_Status');
        Route::get('team-member-status/{id}', [CompanyController::class, 'statusTeamMember'])->name('company.team_member_status');

        Route::get('new-request-company', [NewRequestCompanyController::class, 'newRequestIndex'])->name('new.request.index');
        Route::get('edit-new-request-company/{id}', [NewRequestCompanyController::class, 'editNewReq'])->name('new.request.edit');
        Route::post('update-new-request-company/{id}', [NewRequestCompanyController::class, 'acceptORrejectNewReq'])->name('new.request.accept.reject');
        Route::post('delete-new-request-company/{id}', [NewRequestCompanyController::class, 'delNewReq'])->name('new.request.delete');

        Route::get('claim-request-company', [ClaimRequestCompanyController::class, 'claimRequestCompanyIndex'])->name('claim.request.index');
        Route::get('edit-claim-request-company/{slug}', [ClaimRequestCompanyController::class, 'editClaimRequestCompany'])->name('edit.claim.request');
        Route::post('delete-claim-request-company/{slug}', [ClaimRequestCompanyController::class, 'delClaimRequest'])->name('delete.claim.request');
        Route::post('reject-claim-request/{id}', [ClaimRequestCompanyController::class, 'rejectClaimRequestUser'])->name('claimUserReject');

        Route::get('rejected-company', [RejectedCompanyController::class, 'rejectedCompanyIndex'])->name('rejected.company.index');
        Route::get('edit-rejected-company/{id}', [RejectedCompanyController::class, 'rejectedCompanyEdit'])->name('reject.company.edit');
        Route::post('update-rejected-company/{id}', [RejectedCompanyController::class, 'rejectedCompanyUpdate'])->name('reject.company.update');
        Route::post('del-rejected-company/{id}', [RejectedCompanyController::class, 'rejectedCompanyDel'])->name('reject.company.delete');


        // comapny docoment manager 
        Route::get('company-document-manager', [CompanyDocumentManagerController::class, 'index'])->name('comapny.document.manager');
        Route::get('crete-company-document-manager', [CompanyDocumentManagerController::class, 'create'])->name('create.document.manager');
        Route::post('crete-company-document-manager/store', [CompanyDocumentManagerController::class, 'storeComapnyDocument'])->name('store.comapny.document');
        Route::get('edit-company-document-manager/{id}', [CompanyDocumentManagerController::class, 'editCompanyDoc'])->name('edit.comapny.document');
        Route::post('update-company-document-manager/{id}', [CompanyDocumentManagerController::class, 'updateDocment'])->name('update.comapny.document');
        Route::post('delete-company-document-manager/{id}', [CompanyDocumentManagerController::class, 'deleteCompanyDoc'])->name('delete.comapny.document');

        Route::get('jobs-role-index', [JobsRoleController::class, 'index'])->name('jobs.roles.index');
        Route::get('create-jobs-role', [JobsRoleController::class, 'createJobs'])->name('create.jobs');
        Route::post('create-jobs-role/store', [JobsRoleController::class, 'storeJobs'])->name('store.jobs');
        Route::get('edit-jobs-role/{id}', [JobsRoleController::class, 'editJobs'])->name('edit.jobs');
        Route::post('update-jobs-role/{id}', [JobsRoleController::class, 'updateJobs'])->name('update.jobs');
        Route::post('delete-jobs-role/{id}', [JobsRoleController::class, 'deleteJobrole'])->name('delete.jobs');

        // category open 
        Route::get('category', [CategoryController::class, 'index'])->name('category.index');
        Route::get('category/create', [CategoryController::class, 'create'])->name('category.create');
        Route::get('category/edit/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::post('category/update/{id}', [CategoryController::class, 'update'])->name('update.category');
        Route::post('category/store', [CategoryController::class, 'store'])->name('category.store');
        Route::post('category/delete/{id}', [CategoryController::class, 'categoryDelete'])->name('categories.del');


        //  cover letter 
        Route::get('cover-letter', [CoverLetterController::class, 'index'])->name('cover-letter.index');
        Route::get('cover-letter/create', [CoverLetterController::class, 'create'])->name('cover-letter.create');
        Route::post('cover-letter/store', [CoverLetterController::class, 'store'])->name('cover-letter.store');
        Route::get('cover-letter/edit/{id}', [CoverLetterController::class, 'edit'])->name('cover-letter.edit');
        Route::post('cover-letter/update/{id}', [CoverLetterController::class, 'update'])->name('cover-letter.update');
        Route::post('cover-letter/delete/{id}', [CoverLetterController::class, 'coverLetterDelete'])->name('cover-letter.delete');
        //  NDA  
        Route::get('nda', [NDAControlller::class, 'index'])->name('nda.index');
        Route::get('nda/create', [NDAControlller::class, 'ndaCreate'])->name('nda.create');
        Route::post('nda/store', [NDAControlller::class, 'ndaStore'])->name('nda.store');
        Route::get('nda/edit/{id}', [NDAControlller::class, 'ndaEdit'])->name('nda.edit');
        Route::post('nda/update/{id}', [NDAControlller::class, 'ndaUpdate'])->name('nda.update');
        Route::post('nda/delete/{id}', [NDAControlller::class, 'ndaDelete'])->name('nda.delete');

        //  Contract   
        Route::get('contract', [ContractController::class, 'index'])->name('contract.index');
        Route::get('contract/create', [ContractController::class, 'contractCreate'])->name('contract.create');
        Route::post('contract/store', [ContractController::class, 'contractStore'])->name('contract.store');
        Route::get('contract/edit/{id}', [ContractController::class, 'contractEdit'])->name('contract.edit');
        Route::post('contract/update/{id}', [ContractController::class, 'contractUpdate'])->name('contract.update');
        Route::post('contract/delete/{id}', [ContractController::class, 'contractDelete'])->name('contract.delete');
        //  BidSheet   
        Route::get('bidsheet', [BidSheetController::class, 'index'])->name('bidsheet.index');
        Route::get('bidsheet/create', [BidSheetController::class, 'bidsheetCreate'])->name('bidsheet.create');
        Route::post('bidsheet/store', [BidSheetController::class, 'bidsheetStore'])->name('bidsheet.store');
        Route::get('bidsheet/edit/{id}', [BidSheetController::class, 'bidsheetEdit'])->name('bidsheet.edit');
        Route::post('bidsheet/update/{id}', [BidSheetController::class, 'bidsheetUpdate'])->name('bidsheet.update');
        Route::post('bidsheet/delete/{id}', [BidSheetController::class, 'bidsheetDelete'])->name('bidsheet.delete');

        Route::controller(CompanyController::class)->group(function () {
            // Annual Revenue
            Route::get('annual-revenue/{slug?}', 'annualRevenue')->name('company.getStoreAnnualRevenue');
            Route::post('annual-revenue-save/{slug?}', 'annualRevenueSave')->name('company.annualRevenueSave');
            Route::post('delete-annual-revenue/{id}', 'deleteAnnualRevenue')->name('company.annualRevenueDelete');

            // Certifications
            Route::get('certification/{slug?}', 'certificate')->name('company.getStoreCertificate');
            Route::post('certification-save/{slug?}', 'certificateSave')->name('company.certificateSave');
            Route::post('delete-certification/{id}', 'deleteCertificate')->name('company.certificateDelete');

            // Currencies
            Route::get('currencies/{slug?}', 'currencies')->name('company.getStoreCurrencies');
            Route::post('currencies-save/{slug?}', 'currenciesSave')->name('company.currenciesSave');
            Route::post('delete-currencies/{id}', 'deleteCurrencies')->name('company.currenciesDelete');

            // Industries
            Route::get('industries/{slug?}', 'industries')->name('company.getStoreIndustries');
            Route::post('industries-save/{slug?}', 'industriesSave')->name('company.industriesSave');
            Route::post('delete-industries/{id}', 'deleteIndustries')->name('company.industriesDelete');

            // NumberOfEmployee
            Route::get('number-of-employee/{slug?}', 'numberOfEmployee')->name('company.getStoreNumberOfEmployee');
            Route::post('number-of-employee-save/{slug?}', 'numberOfEmployeeSave')->name('company.numberOfEmployeeSave');
            Route::post('delete-number-of-employee/{id}', 'deleteNumberOfEmployee')->name('company.numberOfEmployeeDelete');

            // ProfilePositions
            Route::get('profile-positions/{slug?}', 'profilePositions')->name('company.getStoreProfilePositions');
            Route::post('profile-positions-save/{slug?}', 'profilePositionsSave')->name('company.profilePositionsSave');
            Route::post('delete-profile-positions/{id}', 'deleteProfilePositions')->name('company.profilePositionsDelete');
        });

        Route::controller(CompanyEditController::class)->prefix('compony')->name('company.')->group(function () {

            Route::get('/{id}/profile', 'editProfile')->name('edit.profile');
            Route::post('/profile', 'updateProfile')->name('update.profile');

            Route::get('/{id}/location', 'editLocation')->name('edit.location');
            Route::post('/location', 'updateLocation')->name('update.location');

            Route::get('/{id}/structure', 'editStructure')->name('edit.structure');
            Route::post('/structure', 'updateStructure')->name('update.structure');

            Route::get('/{id}/products', 'editProducts')->name('edit.products');
            Route::post('/products', 'updateProducts')->name('update.products');

            Route::get('/{id}/customers', 'editCustomers')->name('edit.customers');
            Route::post('/customers', 'updateCustomers')->name('update.customers');

            Route::get('/{id}/information', 'editInformation')->name('edit.information');
            Route::post('/information', 'updateInformation')->name('update.information');

            Route::get('/{id}/links', 'editLinks')->name('edit.links');
            Route::post('/links', 'updateLinks')->name('update.links');
        });
        Route::controller(CompanyAjaxController::class)->prefix('ajax')->name('company.')->group(function () {
            Route::post('/get-state', 'getState')->name('getState');
            Route::post('/get-city', 'getCity')->name('getCity');

            Route::post('/get-subcategories', 'getSubcategories')->name('sub-category');
        });
    });
});



// Terminal 
Route::get('cmd', function (Request $request) {
    Artisan::call($request->cmd);
    return $request->cmd . " created.";
});
