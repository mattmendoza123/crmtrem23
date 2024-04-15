<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');


require APPPATH. 'third_party/googleads-php-lib/vendor/autoload.php';

use Google\AdsApi\AdManager\AdManagerSession;
use Google\AdsApi\AdManager\AdManagerSessionBuilder;
use Google\AdsApi\AdManager\Util\v202402\ReportDownloader;
use Google\AdsApi\AdManager\v202402\Column;
use Google\AdsApi\AdManager\v202402\DateRangeType;
use Google\AdsApi\AdManager\v202402\Dimension;
use Google\AdsApi\AdManager\v202402\ExportFormat;
use Google\AdsApi\AdManager\v202402\ReportJob;
use Google\AdsApi\AdManager\v202402\ReportQuery;
use Google\AdsApi\AdManager\v202402\ReportQueryAdUnitView;
use Google\AdsApi\AdManager\v202402\ServiceFactory;
use Google\AdsApi\Common\OAuth2TokenBuilder;

/**
 * This example runs a reach report with ad unit dimensions.
 *
 * This example is meant to be run from a command line (not as a webpage) and
 * requires that you've setup an `adsapi_php.ini` file in your home directory
 * with your API credentials and settings. See `README.md` for more info.
 */
class Adwords{

    public static function runExample(
        ServiceFactory $serviceFactory,
        AdManagerSession $session
    ) {
        $reportService = $serviceFactory->createReportService($session);

        // Create report query.
        $reportQuery = new ReportQuery();
        $reportQuery->setAdUnitView(ReportQueryAdUnitView::FLAT);
        $reportQuery->setDimensions(
            [
                Dimension::MONTH_AND_YEAR,
                Dimension::COUNTRY_NAME,
                Dimension::AD_UNIT_ID,
                Dimension::AD_UNIT_NAME
            ]
        );
        $reportQuery->setColumns(
            [
                Column::UNIQUE_REACH_FREQUENCY,
                Column::UNIQUE_REACH_IMPRESSIONS,
                Column::UNIQUE_REACH
            ]
        );

        $reportQuery->setDateRangeType(DateRangeType::LAST_MONTH);

        // Create report job.
        $reportJob = new ReportJob();
        $reportJob->setReportQuery($reportQuery);

        // Run report job.
        $reportJob = $reportService->runReportJob($reportJob);

        // Create report downloader to poll report's status and download when
        // ready.
        $reportDownloader = new ReportDownloader(
            $reportService,
            $reportJob->getId()
        );
        if ($reportDownloader->waitForReportToFinish()) {
            // Write to system temp directory by default.
            $filename = tempnam(sys_get_temp_dir(),
                'reach-report-with-ad-unit-dimensions');
            $filePath = sprintf(
                '%s.csv.gz',
                $filename
            );
            printf("Downloading report to %s ...%s", $filePath, PHP_EOL);
            // Download the report.
            $reportDownloader->downloadReport(
                ExportFormat::CSV_DUMP,
                $filePath
            );
            print "Done.\n";
        } else {
            print "Report failed.\n";
        }
    }

    public function index()
    {
        $oAuth2Credential = (new OAuth2TokenBuilder())->fromFile($_SERVER['DOCUMENT_ROOT']."/adsapi_php.ini")
            ->build();
        $session = (new AdManagerSessionBuilder())->fromFile($_SERVER['DOCUMENT_ROOT']."/adsapi_php.ini")
            ->withOAuth2Credential($oAuth2Credential)
            ->build();
        self::runExample(new ServiceFactory(), $session);
    }
}

#RunReachReportWithAdUnitDimensions::main();
