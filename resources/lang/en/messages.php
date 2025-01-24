<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Response Messages Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

	'BUSINESS_DESCRIPTION' => 'Health Services',

	'USER_GENERAL_INFO' => 'Fetched user general info.',
	'ADD_CREDIT_CARD' => 'Before posting a job you must add your credit card information',
	'VERIFY_STRIPE_ACCOUNT' => 'You either haven\'t filled the payment information form or its pending approval. This is mandatory before applying to jobs. Please check with the Sintra Team.',
	'PAYMENT_DONE' => 'Payment done successfully.',
	'CARD_ADDED' => 'Your credit card has been added successfully.',
	'CARD_UPDATED' => 'Credit card information updated successfully.',
	'CARD_DELETED' => 'Credit card information deleted successfully.',
	'LISTING_ALL_CARDS' => 'Card listed successfully.',
	'BANK_ACCOUNT_DETAILS' => 'Bank account details.',

	'ACCOUNT_ADDED' => 'Bank account information added successfully.',
	'ACCOUNT_UPDATED' => 'Bank account information updated successfully.',
	'ACCOUNT_AND_BANK_ADDED' => 'Created account and added the bank successfully.',
	'BANK_ADDED' => 'Bank added successfully.',
	'BANK_UPDATED' => 'Bank updated successfully.',

	'VERIFICATION_DONE' => 'Identification successful.',
	'VERIFICATION_IN_PROCESS' => 'Identification in process.',

	'JOB_COMPLETED' => 'Job completed successfully.',
	'JOB_CANCELLED' => 'Job cancelled successfully.',

	'ALREADY_PAYED' => 'Payment has been done for this job.',
	'ALREADY_COMPLETED' => 'Already completed the job.',

    'LISTING_ALL_TRANSACTIONS' => 'Listing all transactions.',

	'EMPLOYER_REGISTERED' => 'Profile registered successfully.',
	'CANDIDATE_REGISTERED' => 'Profile registered successfully.',

	'PHONE_VERIFIED' => 'Phone number has been verified.',
	'VERIFICATION_CODE_SENT' => 'Phone verification code has been sent.',

	'DOCUMENT_LIST' => 'Listing documents.',
	'DOCUMENT_UPLOADED' => 'Document uploaded successfully.',
	'DOCUMENT_DELETED' => 'Document deleted successfully.',
	'PROFILE_IMAGE_UPDATED' => 'Profile image updated successfully.',
	'PROFILE_IMAGE_REMOVED' => 'Profile image removed successfully.',

	'LOGGED_OUT' => 'Logged out successfully.',
	'LOGGED_IN' => 'Logged in successfully.',
	'EMAIL_NOT_FOUND' => 'Incorrect email or password.',

	'DEVICE_INFO_UPDATED' => 'Device info updated.',
	'LISTING_CITIES' => 'Listing cities.',
	'FETCHED_STATIC_DATA' => 'Fetched static data.',
	'LISTING_TIMEZONES' => 'Listing timezones.',

	'SKILLS_UPDATED' => 'Skills updated.',
	'COLLEGE_UPDATED' => 'College updated.',
	'GRADUATION_UPDATED' => 'Graduation year updated.',
	'SOFTWARES_UPDATED' => 'Softwares updated.',
	'SPECIALIZATION_UPDATED' => 'Specialization updated.',
	'LANGUAGES_UPDATED' => 'Languages updated.',
	'CLINIC_UPDATED' => 'Clinic updated.',
	'EXPERIENCE_UPDATED' => 'Experience updated.',
	'DISTANCE_UPDATED' => 'Job search distance updated.',
	'AVERAGE_RECALL_TIME_UPDATED' => 'Average recall time updated.',

	'CANDIDATE_UPDATED' => 'Profile updated.',
	'EMPLOYER_UPDATED' => 'Profile updated.',
	'USER_FULL_PROFILE' => 'User full profile.',

	'JOB_ADDED' => 'Job successfully posted.',
	'JOB_APPLIED' => 'Successfully applied for job.',

	'FEEDBACK_ADDED' => 'Feedback added.',
	'CLINIC_RATINGS_ADDED' => 'Clinic ratings submitted.',
	'CANDIDATE_RATINGS_ADDED' => 'Candidate ratings submitted.',
	
	'JOB_SEARCH_LIST' => 'Listing jobs.',
	'JOB_DATE_LIST' => 'Listing job dates.',
	'JOB_DETAILS' => 'Job details.',
	'JOB_LIST' => 'Listing jobs.',

	'CANDIDATE_HIRED' => 'Candidate hired.',
	'COUNTER_OFFER_MADE' => 'Counter offer sent.',
	'COUNTER_OFFER_ACCEPTED' => 'Counter offer accepted.',
	'COUNTER_OFFER_REJECTED' => 'Counter offer rejected.',
	'JOB_MARKED_FAV' => 'Candidate added to favorites.',
	'JOB_MARKED_UNFAV' => 'Candidate removed from favorites.',
	'NOT_VALID_APPLICANT' => 'Invalid job application id.',
	'ALREADY_APPLIED_FOR_JOB' => 'You have already applied for this job.',
	'APPLYING_FOR_JOB_BLOCKED' => 'Your account has been blocked. Please contact Sintra Team',
	'CREATING_JOB_BLOCKED' => 'Your account has been blocked. Please contact Sintra Team',
	'HIRING_FOR_JOB_BLOCKED' => 'Your account has been blocked. Please contact Sintra Team.',
	'COUNTER_OFFER_FOR_JOB_BLOCKED' => 'Your account has been blocked. Please contact Sintra Team.',
	'ALREADY_HAVE_BOOKING_DATE' => 'You already have a shift scheduled during this time.',
	'CANDIDATE_IS_NOT_AVAILABLE' => 'Candidate is not available during this time.',
	'CANDIDATE_MARKED_NOSHOW' => 'Candidate reported as noshow.',
    'COLLEGE_REQUIRED' => 'College name required.',

	'DELIVERED_PUSH_MESSAGE' => ':user :date_time Feedback added.',

	'MSG0001' => 'Thanks for registering with Sintra. Your verification code is :code.',

	'NOTIFICATIONS_LISTING' => 'Listing notifications.',
	'NOTIFICATIONS_UPDATED' => 'Read notification(s).',
	'NOTIFICATIONS_DELETED' => 'Deleted notification(s).',

	'FREE_LUNCH_MINUTES' => 'You have selected free lunch while posting the job.',
	'FREE_CANCELLATION_MINUTES' => 'You have selected free cancellation while posting the job.',
    
    'NEW_APPLICANT_TITLE' => 'New Applicant',
    'NEW_APPLICANT_BODY' => ':user has applied for the :title - :formatted_date shift.',
    'NEW_APPLICANT_BODY_HTML' => '<b>:user</b> has applied for the <b>:title</b> shift.',
    
    'CARD_AUTHORISED_TITLE' => 'Card Authorised',
    'CARD_AUTHORISED_BODY' => 'Your card payment has been authorised for the job assigned to :user on :date',
    'CARD_AUTHORISED_BODY_HTML' => 'Your card payment has been authorised for the job assigned to :user on :date',
    
    'CARD_RE_AUTHORISED_TITLE' => 'ACTION REQUIRED - Failed Credit Card Authorization',
    'CARD_RE_AUTHORISED_BODY' => 'Please update credit card information otherwise the :title - :formatted_date shift will be cancelled in 3hrs from now.',
    'CARD_RE_AUTHORISED_BODY_HTML' => 'Please update credit card information otherwise the <b>:title</b> shift will be cancelled in 3hrs from now.',
    
    'CARD_AUTHORISED_FAILED_TITLE' => 'Card Authorisation Failed',
    'CARD_AUTHORISED_FAILED_BODY' => 'Your card authorisation failed, the job assigned to :user on :formatted_date has been removed.',
    'CARD_AUTHORISED_FAILED_BODY_HTML' => 'Your card authorisation failed, the job assigned to :user on :formatted_date has been removed.',
    
    'AUTH_FAILED_CANCELLED_JOB_TITLE' => 'Job Cancelled.',
    'AUTH_FAILED_CANCELLED_JOB_BODY' => 'Your job on :formatted_date shift at :office has been cancelled.',
    'AUTH_FAILED_CANCELLED_JOB_BODY_HTML' => 'Your job on :formatted_date shift at :office has been cancelled.',
    
    'CARD_CAPTURED_TITLE' => 'Thank You',
    'CARD_CAPTURED_BODY' => 'C$:amount has been charged from you credit card for :title - :formatted_date shift',
    'CARD_CAPTURED_BODY_HTML' => '<b>C$:amount</b> has been charged from you credit card for <b>:title</b> shift',

    'CARD_CAPTURED_FAILED_TITLE' => 'Payment Failed',
    'CARD_CAPTURED_FAILED_BODY' => 'Your payment failed, for the job assigned to :user on :formatted_date.',
    'CARD_CAPTURED_FAILED_BODY_HTML' => 'Your payment failed, for the job assigned to :user on :formatted_date.',

    'PAYMENT_TRANSFERRED_TITLE' => 'Payment Deposited',
    'PAYMENT_TRANSFERRED_BODY' => 'C$:amount has been deposited in your bank account for your :title - :formatted_date shift at :office',
    'PAYMENT_TRANSFERRED_BODY_HTML' => '<b>C$:amount</b> has been deposited in your bank account for your <b>:title</b> shift at <b>:office</b>',

    'JOB_CANCELLED_EM_TITLE' => 'Job Cancelled',
    'JOB_CANCELLED_EM_BODY' => 'We regret to inform you that :office has cancelled the following shift: :title - :formatted_date.',
    'JOB_CANCELLED_EM_BODY_HTML' => 'We regret to inform you that <b>:office</b> has cancelled the following shift: <b>:title</b>.',
    
    'JOB_CANCELLED_CA_TITLE' => 'Candidate Withdrew',
    'JOB_CANCELLED_CA_BODY' => 'We regret to inform you that :user has withdrawn from the :title - :formatted_date shift. This job has been automatically reposted.',
    'JOB_CANCELLED_CA_BODY_HTML' => 'We regret to inform you that <b>:user</b> has withdrawn from the <b>:title</b> shift. This job has been automatically reposted.',
    'JOB_CANCELLED_CA_PENALTY_BODY' => 'We regret to inform you :user has withdrawn from the :title - :formatted_date shift.',
    'JOB_CANCELLED_CA_PENALTY_BODY_HTML' => 'We regret to inform you <b>:user</b> has withdrawn from the <b>:title</b> shift.',

    'CANDIDATE_REMOVED_FROM_JOB_TITLE' => 'Candidate Removed From Job',
    'CANDIDATE_REMOVED_FROM_JOB_BODY' => 'Candidate for :title - :date has been removed, job is open.',
    'CANDIDATE_REMOVED_FROM_JOB_BODY_HTML' => 'Candidate for :title - :date has been removed, job is open.',

    'SELECTED_FOR_JOB_TITLE' => 'You\'ve Been Selected',
    'SELECTED_FOR_JOB_BODY' => ':title shift at :office - :formatted_date',
    'SELECTED_FOR_JOB_BODY_HTML' => '<b>:title</b> shift at <b>:office</b>',

    'COUNTER_OFFER_RECIEVED_TITLE' => 'ACTION REQUIRED - Counter Offer',
    'COUNTER_OFFER_RECIEVED_BODY' => ':title - :formatted_date shift at :office',
    'COUNTER_OFFER_RECIEVED_BODY_HTML' => '<b>:title</b> shift at <b>:office</b>',

    'COUNTER_OFFER_REJECTED_TITLE' => 'Counter Offer Rejected',
    'COUNTER_OFFER_REJECTED_BODY' => ':user - :title - :formatted_date shift. Please select another candidate.',
    'COUNTER_OFFER_REJECTED_BODY_HTML' => '<b>:user</b> - <b>:title</b> shift. Please select another candidate.',

    'COUNTER_OFFER_ACCEPTED_TITLE' => 'Counter Offer Accepted',
    'COUNTER_OFFER_ACCEPTED_BODY' => ':user - :title - :formatted_date shift.',
    'COUNTER_OFFER_ACCEPTED_BODY_HTML' => '<b>:user</b> - <b>:title</b> shift.',

    'CANDIDATE_AWAITING_REVIEW_TITLE' => 'Applicants Waiting To Be Reviewed',
    'CANDIDATE_AWAITING_REVIEW_BODY' => ':count - :date',
    'CANDIDATE_AWAITING_REVIEW_BODY_HTML' => ':count - :date',

    'CANDIDATE_NOSHOW_TITLE' => 'ACTION REQUIRED - Account Blocked',
    'CANDIDATE_NOSHOW_BODY' => 'Dear :user, your account has been temporarily blocked as you were marked as a no show for the following shift: :title - :formatted_date at :office. Please call us ASAP to address the issue.',
    'CANDIDATE_NOSHOW_BODY_HTML' => 'Dear <b>:user</b>, your account has been temporarily blocked as you were marked as a no show for the following shift: <b>:title</b> at <b>:office</b>. Please call us ASAP to address the issue.',
    
    'CANDIDATE_CANCELLED_JOB_BLOCKED_TITLE' => 'ACTION REQUIRED - Account Blocked',
    'CANDIDATE_CANCELLED_JOB_BLOCKED_BODY' => 'Dear :user, your account has been temporarily blocked as a result of withdrawing from a shit 12 hrs before start time. :title - :formatted_date at :office. Please call us ASAP to address the issue.',
    'CANDIDATE_CANCELLED_JOB_BLOCKED_BODY_HTML' => 'Dear <b>:user</b>, your account has been temporarily blocked as a result of withdrawing from a shit 12 hrs before start time. <b>:title</b> at <b>:office</b>. Please call us ASAP to address the issue.',
    
    'CANDIDATE_REMINDER_UPCOMING_SHIFT_TITLE' => 'Reminder: Upcoming Shift!',
    'CANDIDATE_REMINDER_UPCOMING_SHIFT_BODY' => 'You have an upcoming :title - :formatted_date shift at :office',
    'CANDIDATE_REMINDER_UPCOMING_SHIFT_BODY_HTML' => 'You have an upcoming <b>:title</b> shift at <b>:office</b>',

    'CANDIDATE_REVIEW_REMINDER_TITLE' => 'ACTION REQUIRED - Review Dental Office',
    'CANDIDATE_REVIEW_REMINDER_BODY' => 'Please review your experience with :office as it relates to the :title - :formatted_date shift.',
    'CANDIDATE_REVIEW_REMINDER_BODY_HTML' => 'Please review your experience with <b>:office</b> as it relates to the <b>:title</b> shift.',

    'EMPLOYER_REVIEW_REMINDER_TITLE' => 'ACTION REQUIRED - Review Candidate',
    'EMPLOYER_REVIEW_REMINDER_BODY' => 'Please review :user\'s performance for the - :title - :formatted_date shift.',
    'EMPLOYER_REVIEW_REMINDER_BODY_HTML' => 'Please review <b>:user\'s</b> performance for the - <b>:title</b> shift.',

    'CANDIDATE_URGENT_REQUIRED_TITLE' => 'Urgent Shift',
    'CANDIDATE_URGENT_REQUIRED_BODY' => 'Urgent requirement for a :title shift at :formatted_date',
    'CANDIDATE_URGENT_REQUIRED_BODY_HTML' => 'Urgent requirement for a <b>:title</b> shift at <b>:office</b>',

    'NEW_JOB_POSTED_TITLE' => 'New Job Alert',
    'NEW_JOB_POSTED_BODY' => ':title shift at :formatted_date',
    'NEW_JOB_POSTED_BODY_HTML' => '<b>:title</b> shift at <b>:formatted_date</b>',

    'DAILY_JOB_STATUS_TITLE' => 'Open Jobs',
    'DAILY_JOB_STATUS_BODY' => 'Hi, Don\'t miss out making extra cash. Check now',
    'DAILY_JOB_STATUS_BODY_HTML' => 'Hi, Don\'t miss out making extra cash. <b>Check now</b>',

    'UNPAID_LUNCH_CANCELLATION_TITLE' => 'ACTION REQUIRED - Candidate Timesheet',
    'UNPAID_LUNCH_CANCELLATION_BODY' => 'Please update candidate lunch and patient cancellation duration for the :title - :formatted_date shift.',
    'UNPAID_LUNCH_CANCELLATION_BODY_HTML' => 'Please update candidate lunch and patient cancellation duration for the <b>:title</b> shift.',

    'KYC_VERIFICATION_COMPLETED_TITLE' => 'Account Activated',
    'KYC_VERIFICATION_COMPLETED_BODY' => 'Congrats - you are now able to apply to all jobs.',
    'KYC_VERIFICATION_COMPLETED_BODY_HTML' => 'Congrats - you are now able to apply to all jobs.',

    'KYC_VERIFICATION_REJECTED_TITLE' => 'ACTION REQUIRED - Direct Deposit Incomplete',
    'KYC_VERIFICATION_REJECTED_BODY' => 'We regret to inform you that your Identify Verification was not approved. Call us to address this issue.',
    'KYC_VERIFICATION_REJECTED_BODY_HTML' => 'We regret to inform you that your <b>Identify Verification</b> was not approved. Call us to address this issue.',

    'KYC_VERIFICATION_NOT_DONE_TITLE' => 'ACTION REQUIRED - Direct Deposit Incomplete',
    'KYC_VERIFICATION_NOT_DONE_BODY' => 'Please submit your Identity Verification form to complete the direct deposit setup.',
    'KYC_VERIFICATION_NOT_DONE_BODY_HTML' => 'Please submit your <b>Identity Verification</b> form to complete the direct deposit setup.',
];