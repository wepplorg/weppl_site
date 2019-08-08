@extends('layouts.users')
@section('content')
<main>
   <!--   <div class="faq_banner_sec">
      <img src="img/FAQ-Backgound.jpg" alt="banner" width="100%"/>
      </div> -->
   <div class="container-fluid">
      <div class="row justify-content-center faq_title_sec">
         <h3 class="faq_title">FAQs</h3>
      </div>
       <div class="ngo_conteiner">
      <h5 class="faq_sub-title"><b>Getting Started:</b></h5>
     
      <div id="accordion">
         <div class="card">
            <div class="card-header">
               <a class="card-link" data-toggle="collapse" href="#collapseOne">
                  <h5>Is Weppl an NGO?</h5>
               </a>
            </div>
            <div id="collapseOne" class="collapse show" data-parent="#accordion">
               <div class="card-body">
                  <ol>
                     <li>Weppl is not an NGO. We are a mission-driven company where social impact and self-sustainability are our primary goals.</li>
                     <li>In order to scale Weppl and reach as many families as possible, we’ve used capital & resources to fund our technology, field operations and other long-term expenditures. Our goal is to be a self-sustainable organization. We charge  basic 12.5% platform fee for our operational and overhead expenses.</li>
                  </ol>
               </div>
            </div>
         </div>
         <!--card-->
         <div class="card">
            <div class="card-header">
               <a class="card-link" data-toggle="collapse" href="#collapseTwo">
                  <h5>How do I start a fundraiser?</h5>
               </a>
            </div>
            <div id="collapseTwo" class="collapse" data-parent="#accordion">
               <div class="card-body">
                  <p>You can start a fundraiser in four easy steps. </p>
                  <ul>
                     <li>Go to weppl fundraiser tab</li>
                     <li>Create an account on Weppl using your email id. </li>
                     <li>Fill in your contact details, write your story, and add images/video. </li>
                     <li>Submit the fundraiser.</li>
                  </ul>
               </div>
            </div>
         </div>
         <!--card-->
         <div class="card">
            <div class="card-header">
               <a class="collapsed card-link" data-toggle="collapse" href="#collapseThree">
                  <h5>What can I raise money for?</h5>
               </a>
            </div>
            <div id="collapseThree" class="collapse" data-parent="#accordion">
               <div class="card-body">
                  <p>These include crowdfunding for charities, medical expenses of friends and family,  education needs, volunteering and fellowships, neighborhood, emergencies, natural disasters, sports, documentaries, rural development, arts, and animal rescue projects to name a few.</p>
               </div>
            </div>
         </div>
         <!--card-->
         <div class="card">
            <div class="card-header">
               <a class="collapsed card-link" data-toggle="collapse" href="#collapseFour">
                  <h5>What does it cost?</h5>
               </a>
            </div>
            <div id="collapseFour" class="collapse" data-parent="#accordion">
               <div class="card-body">
                  <ol>
                     <li>It's free to create and share your online fundraising campaign. There is no sign up fees. Also, there is no restriction of you having to reach the target goal amount.</li>
                     <li>We charge a 12.5% platform fee for our basic plan. In addition, the third party payment processor charges 2 to 3.2 % based on the medium and currency of payment: cards, net banking etc.</li>
                     <li>Please see <a href="{{url('plans')}}" >Pricing & Fees </a>for more info.</li>
                  </ol>
               </div>
            </div>
         </div>
         <!--card-->
         <div class="card">
            <div class="card-header">
               <a class="collapsed card-link" data-toggle="collapse" href="#collapseFive">
                  <h5>Who can fund my campaign?</h5>
               </a>
            </div>
            <div id="collapseFive" class="collapse" data-parent="#accordion">
               <div class="card-body">
                  <p>Anyone across the world can donate to your fundraiser. You can also choose to receive funds only from donors in India in accordance with the legal status of your organisation.</p>
               </div>
            </div>
         </div>
         <!--card-->
         <div class="card">
            <div class="card-header">
               <a class="collapsed card-link" data-toggle="collapse" href="#collapseSix">
                  <h5>How do you verify the legitimacy of a fundraiser?</h5>
               </a>
            </div>
            <div id="collapseSix" class="collapse" data-parent="#accordion">
               <div class="card-body">
                  <p>Weppl is a community of people who believe in the greater good of helping one another. As a result, our users watch for and flag posts they believe to be questionable. We always recommend that you only donate to fundraisers when you feel confident about the cause and legitimacy.</p>
               </div>
            </div>
         </div>
         <!--card-->
         <h5><b>Running a successful fundraiser:</b></h5>
         <div class="card">
            <div class="card-header">
               <a class="collapsed card-link" data-toggle="collapse" href="#collapseSeven">
                  <h5>How should I write my fundraising story?</h5>
               </a>
            </div>
            <div id="collapseSeven" class="collapse" data-parent="#accordion">
               <div class="card-body">
                  <p>Successful fundraisers have 4 common traits</p>
                  <p>A powerful story: People think in stories. Tell the who, what, and why. Who is the fundraiser for? What are / were they like? What happened? Where is the beneficiary located? How will the funds be used? What is your relation to the beneficiary? And so forth. Don't worry about the form and structure - just tell your story in natural manner. Break it up in multiple paragraphs, as it will be easier to read.
                     Telling your story honestly: Answer basic questions any reader would have, such as who the fundraiser is for; what happened; where, when, and why it’s important to you; how you know the organizer or beneficiary; and how the funds will be used.
                  </p>
                  <p>Including a breakdown of the costs that comprise the goal. For example, “How the funds will be used: Rs 10,00,000 will be used for the medical treatment. The remaining funds will be used for day-to-day medical expenses such as medicines, scans and doctor consultation."</p>
                  <p>Supporting documents: Adding videos, high quality images and supporting documents explaining the need.</p>
               </div>
            </div>
         </div>
         <!--card-->
         <div class="card">
            <div class="card-header">
               <a class="collapsed card-link" data-toggle="collapse" href="#collapseEight">
                  <h5>How do I achieve my goal and run a successful fundraiser?</h5>
               </a>
            </div>
            <div id="collapseEight" class="collapse" data-parent="#accordion">
               <div class="card-body">
                  <p>We've seen that successful fundraisers employ the following 6 steps to get their initial momentum.Make the first contribution: Show that you're serious about the cause by making the first contribution to your fundraiser, however small it may be.</p>
                  <p>Announce your fundraiser: Amplify your fundraiser by sharing your fundraiser page link on Facebook and Twitter. As more people share, more people visit your fundraiser page with an intent to contribute. 
                     Change your cover picture: Change your Facebook cover picture with a small caption and link to your fundraiser page to drive more eyeballs to your fundraiser.
                  </p>
                  <p>Thank your donors:  Send a thank you note or tag them in a Facebook post acknowledging their contribution. This encourages mutual friends to notice your fundraiser. 
                     Share updates: Send periodic updates to the donors using the Updates feature on the fundraiser page
                  </p>
               </div>
            </div>
         </div>
         <!--card-->
         <div class="card">
            <div class="card-header">
               <a class="collapsed card-link" data-toggle="collapse" href="#collapseNine">
                  <h5>Who will donate to my fundraiser?</h5>
               </a>
            </div>
            <div id="collapseNine" class="collapse" data-parent="#accordion">
               <div class="card-body">
                  <p>Your fundraiser will be supported by the people in your life. This includes friends, family members, loved ones, coworkers, classmates and teammates. Only after your campaign receives the support of the people you personally know, can it begin to attract the support of others.</p>
               </div>
            </div>
         </div>
         <!--card-->
         <div class="card">
            <div class="card-header">
               <a class="collapsed card-link" data-toggle="collapse" href="#collapseTen">
                  <h5>How will I know if someone donates?</h5>
               </a>
            </div>
            <div id="collapseTen" class="collapse" data-parent="#accordion">
               <div class="card-body">
                  <p>You will receive an email notification each time a donation is made to your crowdfunding campaign. The email will have their name and email id. In case someone donates as anonymous, the email will not have their name or email id.</p>
               </div>
            </div>
         </div>
         <!--card-->
         <div class="card">
            <div class="card-header">
               <a class="collapsed card-link" data-toggle="collapse" href="#collapseelevan">
                  <h5>What if I don't reach my goal?</h5>
               </a>
            </div>
            <div id="collapseelevan" class="collapse" data-parent="#accordion">
               <div class="card-body">
                  <p>No problem. With Weppl, you keep each and every donation you receive. Reaching your goal is not required to withdraw the funds raised.</p>
               </div>
            </div>
         </div>
         <!--card-->
         <div class="card">
            <div class="card-header">
               <a class="collapsed card-link" data-toggle="collapse" href="#collapsetwelve">
                  <h5>Will Weppl promote my fundraiser on social media?</h5>
               </a>
            </div>
            <div id="collapsetwelve" class="collapse" data-parent="#accordion">
               <div class="card-body">
                  <p>Promotion of campaigns are decided by a system generated algorithm, which does not allow any human intervention in order to maintain neutrality of Weppl as a platform. We shall definitely promote your campaign if the system shows your campaign. In order to have your campaign promoted, we strongly encourage you to get initial donations from your close network and also drive shares on social media. This is one of the important criteria for the system.</p>
               </div>
            </div>
         </div>
         <!--card-->
         <h5><b>Pricing:</b></h5>
         <div class="card">
            <div class="card-header">
               <a class="collapsed card-link" data-toggle="collapse" href="#collapsethirteen">
                  <h5>How Much Is Weppl's Fee?</h5>
               </a>
            </div>
            <div id="collapsethirteen" class="collapse" data-parent="#accordion">
               <div class="card-body">
                  <p>It's free to create and share your online crowdfunding campaign. There is no sign-up fee. Weppl charges a 12.5% platform fee (inclusive of GST) for our basic plan. There is also a payment gateway fee that can vary from 2 to 3.2% depending on the payment gateway used. In addition to above marketing fee is included if the campaign gets promoted specifically on digital media.</p>
               </div>
            </div>
         </div>
         <!--card-->
         <div class="card">
            <div class="card-header">
               <a class="collapsed card-link" data-toggle="collapse" href="#collapsefourteen">
                  <h5>Why does Weppl charge a fee?</h5>
               </a>
            </div>
            <div id="collapsefourteen" class="collapse" data-parent="#accordion">
               <div class="card-body">
                  <p>Like any other company, Weppl has operating expenses like  technology, infrastructure, payroll & benefits for our dedicated team of employees. We have created this model so that we can continue to provide great service without worrying about our overheads.  Our team of well qualified professionals with strong focus on our donors and organizers ensure we provide a great experience in raising money for the causes they care for.</p>
               </div>
            </div>
         </div>
         <!--card-->
          <h5><b>For Donors:</b></h5>
         <div class="card">
            <div class="card-header">
               <a class="collapsed card-link" data-toggle="collapse" href="#collapsefiveteen">
                  <h5>I don't want my contribution to be visible to anyone. What should I do?</h5>
               </a>
            </div>
            <div id="collapsefiveteen" class="collapse" data-parent="#accordion">
               <div class="card-body">
                  <p>You can choose <b>'Pay as Anonymous'</b> while making a payment to any fundraiser, and you'll remain anonymous (including the organizer). You can also choose the 'Remain Anonymous' option while editing your profile.</p>
               </div>
            </div>
         </div>
         <!--card-->
         <div class="card">
            <div class="card-header">
               <a class="collapsed card-link" data-toggle="collapse" href="#collapsesixteen">
                  <h5>How do I get my tax-exempt benefit receipt?</h5>
               </a>
            </div>
            <div id="collapsesixteen" class="collapse" data-parent="#accordion">
               <div class="card-body">
                  <p>You will receive your tax-exemption receipt only after the NGO issues it. Please make sure that you choose to avail tax-exemption while making a donation, and enter all the required details. Once your details are with the NGO, you will receive the tax-exemption receipt in your email as soon as the NGO issues it.</p>
               </div>
            </div>
         </div>
         <!--card-->
         <div class="card">
            <div class="card-header">
               <a class="collapsed card-link" data-toggle="collapse" href="#collapseseventeen">
                  <h5>What deduction percentage can I claim when I get an 80G?</h5>
               </a>
            </div>
            <div id="collapseseventeen" class="collapse" data-parent="#accordion">
               <div class="card-body">
                  <p>Generally, the donations made to NGO's which issues 80G certificates fall under the category of 50%. We would request you to consult some professional who will be able to guide you better, about it.</p>
               </div>
            </div>
         </div>
         <!--card-->
         <div class="card">
            <div class="card-header">
               <a class="collapsed card-link" data-toggle="collapse" href="#collapseeightteen">
                  <h5>Is it safe to donate on weppl?</h5>
               </a>
            </div>
            <div id="collapseeightteen" class="collapse" data-parent="#accordion">
               <div class="card-body">
                  <ol>
                     <li>Our platform features the most secure payment encryption technology (256 bit SSL encryption - the highest in the industry). </li>
                     <li>We don't store any card / banking details of your donors.</li>
                     <li>We take your privacy very seriously and never share your personal information with anyone.</li>
                     <li>You can also choose to be anonymous (to the organizer and the public) while making the donation.</li>
                  </ol>
               </div>
            </div>
         </div>
         <!--card-->
          <h5><b>For non-profits:</b></h5>
         <div class="card">
            <div class="card-header">
               <a class="collapsed card-link" data-toggle="collapse" href="#collapsenineteen">
                  <h5>Who can fundraise for my organization?</h5>
               </a>
            </div>
            <div id="collapsenineteen" class="collapse" data-parent="#accordion">
               <div class="card-body">
                  <p>Anyone can raise money for your organization. If your organization has never raised/received money from Weppl, then we will send an email to the organization's contact asking for statutory information when a crowdfunding campaign is setup for your organization.</p>
               </div>
            </div>
         </div>
         <!--card-->
         <div class="card">
            <div class="card-header">
               <a class="collapsed card-link" data-toggle="collapse" href="#collapseTwenty">
                  <h5>What information is required for my organization?</h5>
               </a>
            </div>
            <div id="collapseTwenty" class="collapse" data-parent="#accordion">
               <div class="card-body">
                  <p>Apart from the project/cause details, the following statutory information and documents are required- </p>
                  <ol>
                     <li>Registered Name of the organization.</li>
                     <li>PAN number of the Organization.</li>
                     <li>Scanned copy of Registration Certificate (.jpeg, .png, .pdf format)</li>
                     <li>80G approval certificate if you have 80G tax-exempt status. </li>
                     <li>FCRA certificate if you have FCRA approval.</li>
                  </ol>
               </div>
            </div>
         </div>
         <!--card-->
      </div>
      <!--accordion-->
   </div>
   </div>
</main>
@endsection