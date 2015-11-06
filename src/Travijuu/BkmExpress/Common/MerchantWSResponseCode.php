<?php
namespace Travijuu\BkmExpress\Common;

class MerchantWSResponseCode
{
    // Errors defined in BKM Express
    public static $SUCCESS                  = ["code" => 0, "message" => "Success"];
    public static $UNKNOWN_ERROR            = ["code" => 1, "message" => "Unknown Error"];
    public static $REQUEST_NOT_SYNCHRONIZED = ["code" => 2, "message" => "Request Not Synchronized"];
    public static $MAC_VERIFICATION_FAILED  = ["code" => 3, "message" => "MAC Verification Failed"];
    public static $INPUT_VALIDATION_ERROR   = ["code" => 4, "message" => "INPUT_VALIDATION_ERROR"];
    public static $D3S_MPI_MISSING          = ["code" => 5, "message" => "D3S_MPI_MISSING"];
    public static $POS_NOT_MATCHING_POS_URL = ["code" => 6, "message" => "POS Not Matching, POS URL"];
    public static $MPI_NOT_MATCHING         = ["code" => 7, "message" => "MPI Not Matching"];
}