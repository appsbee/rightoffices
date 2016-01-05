<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mfepi extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function check_existing_centre() {
		$this->db->select('CentreID');
		$this->db->from('Centre');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function set_existing_data($xml) {

    $status = 0;
    $centredata = array();
    $officedata = array();
    $centrephotos = array();

		$all_centre_ids = $this->db->select('CentreID')->get('Centre')->result_array();
		$centre_ids = array();
		foreach ($all_centre_ids as $centre) {
			$centre_ids[] = $centre['CentreID'];
		}

		if (isset($xml['Centre']) && is_array($xml['Centre']) && count($xml['Centre'])) {
			foreach ($xml['Centre'] as $mainKey => $eachCenter) {
				if (!in_array($eachCenter['CentreID'], $centre_ids)) {

					// Starting with the Center details
					$tempCenterData = array(
						'CentreID' => $eachCenter['CentreID'],
						'CentreChangeDate' => isset($eachCenter['CentreChangeDate']) ? $eachCenter['CentreChangeDate'] : '',
						'OperatorCode' => isset($eachCenter['OperatorCode']) && !is_array($eachCenter['OperatorCode']) ? $eachCenter['OperatorCode'] : '',
						'City' => isset($eachCenter['City']) ? $eachCenter['City'] : '',
						'Address' => isset($eachCenter['Address']) ? $eachCenter['Address'] : '',
						'Postcode' => isset($eachCenter['Postcode']) ? $eachCenter['Postcode'] : '',
						'CentreDescription' => isset($eachCenter['CentreDescription']) ? $eachCenter['CentreDescription'] : '',
						'SearchResults' => isset($eachCenter['SearchResults']) ? $eachCenter['SearchResults'] : '',
						'ShortFormCentreDescriptionEN' => isset($eachCenter['ShortFormCentreDescriptionEN']) ? $eachCenter['ShortFormCentreDescriptionEN'] : '',
						'CentreDescriptionEN' => isset($eachCenter['CentreDescriptionEN']) ? $eachCenter['CentreDescriptionEN'] : '',
						'Currency' => isset($eachCenter['Currency']) ? $eachCenter['Currency'] : '',
						'CostPerPerson' => isset($eachCenter['CostPerPerson']) ? $eachCenter['CostPerPerson'] : '',
						'MinSizeAvailable' => isset($eachCenter['MinSizeAvailable']) ? $eachCenter['MinSizeAvailable'] : '',
						'MaxSizeAvailable' => isset($eachCenter['MaxSizeAvailable']) ? $eachCenter['MaxSizeAvailable'] : '',
						'Totalworkstations' => isset($eachCenter['Totalworkstations']) ? $eachCenter['Totalworkstations'] : '',
						'NearestTrainStation' => isset($eachCenter['NearestTrainStation']) && !is_array($eachCenter['NearestTrainStation']) ? $eachCenter['NearestTrainStation'] : '',
						'NearestRoadLink' => isset($eachCenter['NearestRoadLink']) && !is_array($eachCenter['NearestRoadLink']) ? $eachCenter['NearestRoadLink'] : '',
						'Country' => isset($eachCenter['Country']) ? $eachCenter['Country'] : '',
						'State' => isset($eachCenter['State']) ? $eachCenter['State'] : '',
						'Latitude' => isset($eachCenter['Latitude']) ? $eachCenter['Latitude'] : '',
						'Longitude' => isset($eachCenter['Longitude']) ? $eachCenter['Longitude'] : '',
					);
					$centredata[] = $tempCenterData;

					// Get the office data
					if (isset($eachCenter['OfficeTypes']) && is_array($eachCenter['OfficeTypes']) && count($eachCenter['OfficeTypes']) > 1) {
						foreach ($eachCenter['OfficeTypes'] as $ofcKey => $eachOffice) {
							if (is_array($eachOffice)) {
								foreach ($eachOffice as $subOfcKey => $subOfcData) {
									$tempOfficeData = array(
										'CentreID' => $eachCenter['CentreID'],
										'Type' => isset($eachOffice['Type']) ? $eachOffice['Type'] : '',
										'TypeID' => isset($eachOffice['TypeID']) ? $eachOffice['TypeID'] : '',
										'OfficeTypeAssocID' => isset($eachOffice['OfficeTypeAssocID']) ? $eachOffice['OfficeTypeAssocID'] : '',
										'OfficeTypeChangeDate' => isset($eachOffice['OfficeTypeChangeDate']) ? $eachOffice['OfficeTypeChangeDate'] : '',
										'TypePrice' => isset($eachOffice['TypePrice']) ? $eachOffice['TypePrice'] : '',
										'MinPrice' => isset($eachOffice['MinPrice']) ? $eachOffice['MinPrice'] : '',
										'MaxPrice' => isset($eachOffice['MaxPrice']) ? $eachOffice['MinPrice'] : '',
										'MinSize' => isset($eachOffice['MinSize']) ? $eachOffice['MinSize'] : '',
										'MaxSize' => isset($eachOffice['MaxSize']) ? $eachOffice['MaxSize'] : '',
										'TotalSize' => isset($eachOffice['TotalSize']) ? $eachOffice['TotalSize'] : '',
										'AvailableSpace' => isset($eachOffice['AvailableSpace']) ? $eachOffice['AvailableSpace'] : '',
										'BusinessRates' => isset($eachOffice['BusinessRates']) ? $eachOffice['BusinessRates'] : '',
										'ServiceCharge' => isset($eachOffice['ServiceCharge']) ? $eachOffice['ServiceCharge'] : '',
										'MinTerm' => isset($eachOffice['MinTerm']) ? $eachOffice['MinTerm'] : '',
										'MaxTerm' => isset($eachOffice['MaxTerm']) ? $eachOffice['MaxTerm'] : '',
										'MeasurementTypeID' => isset($eachOffice['MeasurementTypeID']) ? $eachOffice['MeasurementTypeID'] : '',
										'MeasurementType' => isset($eachOffice['MeasurementType']) ? $eachOffice['MeasurementType'] : '',
										'PriceDescription' => isset($eachOffice['PriceDescription']) ? $eachOffice['PriceDescription'] : '',
									);
								}
							} else {
								$tempOfficeData = array(
									'CentreID' => $eachCenter['CentreID'],
									'Type' => isset($eachCenter['OfficeTypes']['Type']) ? $eachCenter['OfficeTypes']['Type'] : '',
									'TypeID' => isset($eachCenter['OfficeTypes']['TypeID']) ? $eachCenter['OfficeTypes']['TypeID'] : '',
									'OfficeTypeAssocID' => isset($eachCenter['OfficeTypes']['OfficeTypeAssocID']) ? $eachCenter['OfficeTypes']['OfficeTypeAssocID'] : '',
									'OfficeTypeChangeDate' => isset($eachOffice['OfficeTypeChangeDate']) ? $eachOffice['OfficeTypeChangeDate'] : '',
									'TypePrice' => isset($eachCenter['OfficeTypes']['TypePrice']) ? $eachCenter['OfficeTypes']['TypePrice'] : '',
									'MinPrice' => isset($eachCenter['OfficeTypes']['MinPrice']) ? $eachCenter['OfficeTypes']['MinPrice'] : '',
									'MaxPrice' => isset($eachCenter['OfficeTypes']['MaxPrice']) ? $eachCenter['OfficeTypes']['MaxPrice'] : '',
									'MinSize' => isset($eachCenter['OfficeTypes']['MinSize']) ? $eachCenter['OfficeTypes']['MinSize'] : '',
									'MaxSize' => isset($eachCenter['OfficeTypes']['MaxSize']) ? $eachCenter['OfficeTypes']['MaxSize'] : '',
									'TotalSize' => isset($eachCenter['OfficeTypes']['TotalSize']) ? $eachCenter['OfficeTypes']['TotalSize'] : '',
									'AvailableSpace' => isset($eachCenter['OfficeTypes']['AvailableSpace']) ? $eachCenter['OfficeTypes']['AvailableSpace'] : '',
									'BusinessRates' => isset($eachCenter['OfficeTypes']['BusinessRates']) ? $eachCenter['OfficeTypes']['BusinessRates'] : '',
									'ServiceCharge' => isset($eachCenter['OfficeTypes']['ServiceCharge']) ? $eachCenter['OfficeTypes']['ServiceCharge'] : '',
									'MinTerm' => isset($eachCenter['OfficeTypes']['MinTerm']) ? $eachCenter['OfficeTypes']['MinTerm'] : '',
									'MaxTerm' => isset($eachCenter['OfficeTypes']['MaxTerm']) ? $eachCenter['OfficeTypes']['MaxTerm'] : '',
									'MeasurementTypeID' => isset($eachCenter['OfficeTypes']['MeasurementTypeID']) ? $eachCenter['OfficeTypes']['MeasurementTypeID'] : '',
									'MeasurementType' => isset($eachCenter['OfficeTypes']['MeasurementType']) ? $eachCenter['OfficeTypes']['MeasurementType'] : '',
									'PriceDescription' => isset($eachCenter['OfficeTypes']['PriceDescription']) ? $eachCenter['OfficeTypes']['PriceDescription'] : '',
								);
							}
						}
						$officedata[] = $tempOfficeData;
					}

					// Get the photos data
					if (isset($eachCenter['Photos']['Photo']) && is_array($eachCenter['Photos']['Photo']) && count($eachCenter['Photos']['Photo'])) {
						foreach ($eachCenter['Photos']['Photo'] as $photoKey => $eachPhoto) {
							$tempPhotoData = array(
								'CentreID' => $eachCenter['CentreID'],
								'displayorder' => isset($eachPhoto['displayorder']) ? $eachPhoto['displayorder'] : '',
								'imagesizelabel' => isset($eachPhoto['imagesizelabel']) ? $eachPhoto['imagesizelabel'] : '',
								'imagewidth' => isset($eachPhoto['imagewidth']) ? $eachPhoto['imagewidth'] : '',
								'imageheight' => isset($eachPhoto['imageheight']) ? $eachPhoto['imageheight'] : '',
								'url' => isset($eachPhoto['url']) ? $eachPhoto['url'] : '',
							);
							$centrephotos[] = $tempPhotoData;
						}
					}
				}
			}

			/*echo '<pre>';
			print_r($centredata);
			print_r($officedata);
			print_r($centrephotos);*/
			

			if (isset($centredata) && is_array($centredata) && count($centredata) ) {
				$this->db->insert_batch('Centre', $centredata);
			}

			if (isset($officedata) && is_array($officedata) && count($officedata) ) {
				$this->db->insert_batch('OfficeTypes', $officedata);
			}

			if (isset($centrephotos) && is_array($centrephotos) && count($centrephotos) ) {
				$this->db->insert_batch('Photos', $centrephotos);
			}
			$status = 1;
		}
		return $status;
	}

	public function set_new_data($xml) {
		if (!isset($xml)) {
			return false;
		}

		$status = 0;
		$centredata = array();
		$officedata = array();
		$centrephotos = array();

		$this->db->truncate('Centre');
		$this->db->truncate('OfficeTypes');
		$this->db->truncate('Photos');

		if (isset($xml['Centre']) && is_array($xml['Centre']) && count($xml['Centre'])) {
			foreach ($xml['Centre'] as $mainKey => $eachCenter) {

				// Starting with the Center details
				$tempCenterData = array(
					'CentreID' => $eachCenter['CentreID'],
					'CentreChangeDate' => isset($eachCenter['CentreChangeDate']) ? $eachCenter['CentreChangeDate'] : '',
					'OperatorCode' => isset($eachCenter['OperatorCode']) && !is_array($eachCenter['OperatorCode']) ? $eachCenter['OperatorCode'] : '',
					'City' => isset($eachCenter['City']) ? $eachCenter['City'] : '',
					'Address' => isset($eachCenter['Address']) ? $eachCenter['Address'] : '',
					'Postcode' => isset($eachCenter['Postcode']) ? $eachCenter['Postcode'] : '',
					'CentreDescription' => isset($eachCenter['CentreDescription']) ? $eachCenter['CentreDescription'] : '',
					'SearchResults' => isset($eachCenter['SearchResults']) ? $eachCenter['SearchResults'] : '',
					'ShortFormCentreDescriptionEN' => isset($eachCenter['ShortFormCentreDescriptionEN']) ? $eachCenter['ShortFormCentreDescriptionEN'] : '',
					'CentreDescriptionEN' => isset($eachCenter['CentreDescriptionEN']) ? $eachCenter['CentreDescriptionEN'] : '',
					'Currency' => isset($eachCenter['Currency']) ? $eachCenter['Currency'] : '',
					'CostPerPerson' => isset($eachCenter['CostPerPerson']) ? $eachCenter['CostPerPerson'] : '',
					'MinSizeAvailable' => isset($eachCenter['MinSizeAvailable']) ? $eachCenter['MinSizeAvailable'] : '',
					'MaxSizeAvailable' => isset($eachCenter['MaxSizeAvailable']) ? $eachCenter['MaxSizeAvailable'] : '',
					'Totalworkstations' => isset($eachCenter['Totalworkstations']) ? $eachCenter['Totalworkstations'] : '',
					'NearestTrainStation' => isset($eachCenter['NearestTrainStation']) && !is_array($eachCenter['NearestTrainStation']) ? $eachCenter['NearestTrainStation'] : '',
					'NearestRoadLink' => isset($eachCenter['NearestRoadLink']) && !is_array($eachCenter['NearestRoadLink']) ? $eachCenter['NearestRoadLink'] : '',
					'Country' => isset($eachCenter['Country']) ? $eachCenter['Country'] : '',
					'State' => isset($eachCenter['State']) ? $eachCenter['State'] : '',
					'Latitude' => isset($eachCenter['Latitude']) ? $eachCenter['Latitude'] : '',
					'Longitude' => isset($eachCenter['Longitude']) ? $eachCenter['Longitude'] : '',
				);
				$centredata[] = $tempCenterData;

				// Get the office data
				if (isset($eachCenter['OfficeTypes']) && is_array($eachCenter['OfficeTypes']) && count($eachCenter['OfficeTypes']) > 1) {
					foreach ($eachCenter['OfficeTypes'] as $ofcKey => $eachOffice) {
						if (is_array($eachOffice)) {
							foreach ($eachOffice as $subOfcKey => $subOfcData) {
								$tempOfficeData = array(
									'CentreID' => $eachCenter['CentreID'],
									'Type' => isset($eachOffice['Type']) ? $eachOffice['Type'] : '',
									'TypeID' => isset($eachOffice['TypeID']) ? $eachOffice['TypeID'] : '',
									'OfficeTypeAssocID' => isset($eachOffice['OfficeTypeAssocID']) ? $eachOffice['OfficeTypeAssocID'] : '',
									'OfficeTypeChangeDate' => isset($eachOffice['OfficeTypeChangeDate']) ? $eachOffice['OfficeTypeChangeDate'] : '',
									'TypePrice' => isset($eachOffice['TypePrice']) ? $eachOffice['TypePrice'] : '',
									'MinPrice' => isset($eachOffice['MinPrice']) ? $eachOffice['MinPrice'] : '',
									'MaxPrice' => isset($eachOffice['MaxPrice']) ? $eachOffice['MinPrice'] : '',
									'MinSize' => isset($eachOffice['MinSize']) ? $eachOffice['MinSize'] : '',
									'MaxSize' => isset($eachOffice['MaxSize']) ? $eachOffice['MaxSize'] : '',
									'TotalSize' => isset($eachOffice['TotalSize']) ? $eachOffice['TotalSize'] : '',
									'AvailableSpace' => isset($eachOffice['AvailableSpace']) ? $eachOffice['AvailableSpace'] : '',
									'BusinessRates' => isset($eachOffice['BusinessRates']) ? $eachOffice['BusinessRates'] : '',
									'ServiceCharge' => isset($eachOffice['ServiceCharge']) ? $eachOffice['ServiceCharge'] : '',
									'MinTerm' => isset($eachOffice['MinTerm']) ? $eachOffice['MinTerm'] : '',
									'MaxTerm' => isset($eachOffice['MaxTerm']) ? $eachOffice['MaxTerm'] : '',
									'MeasurementTypeID' => isset($eachOffice['MeasurementTypeID']) ? $eachOffice['MeasurementTypeID'] : '',
									'MeasurementType' => isset($eachOffice['MeasurementType']) ? $eachOffice['MeasurementType'] : '',
									'PriceDescription' => isset($eachOffice['PriceDescription']) ? $eachOffice['PriceDescription'] : '',
								);
							}
						} else {
							$tempOfficeData = array(
								'CentreID' => $eachCenter['CentreID'],
								'Type' => isset($eachCenter['OfficeTypes']['Type']) ? $eachCenter['OfficeTypes']['Type'] : '',
								'TypeID' => isset($eachCenter['OfficeTypes']['TypeID']) ? $eachCenter['OfficeTypes']['TypeID'] : '',
								'OfficeTypeAssocID' => isset($eachCenter['OfficeTypes']['OfficeTypeAssocID']) ? $eachCenter['OfficeTypes']['OfficeTypeAssocID'] : '',
								'OfficeTypeChangeDate' => isset($eachOffice['OfficeTypeChangeDate']) ? $eachOffice['OfficeTypeChangeDate'] : '',
								'TypePrice' => isset($eachCenter['OfficeTypes']['TypePrice']) ? $eachCenter['OfficeTypes']['TypePrice'] : '',
								'MinPrice' => isset($eachCenter['OfficeTypes']['MinPrice']) ? $eachCenter['OfficeTypes']['MinPrice'] : '',
								'MaxPrice' => isset($eachCenter['OfficeTypes']['MaxPrice']) ? $eachCenter['OfficeTypes']['MaxPrice'] : '',
								'MinSize' => isset($eachCenter['OfficeTypes']['MinSize']) ? $eachCenter['OfficeTypes']['MinSize'] : '',
								'MaxSize' => isset($eachCenter['OfficeTypes']['MaxSize']) ? $eachCenter['OfficeTypes']['MaxSize'] : '',
								'TotalSize' => isset($eachCenter['OfficeTypes']['TotalSize']) ? $eachCenter['OfficeTypes']['TotalSize'] : '',
								'AvailableSpace' => isset($eachCenter['OfficeTypes']['AvailableSpace']) ? $eachCenter['OfficeTypes']['AvailableSpace'] : '',
								'BusinessRates' => isset($eachCenter['OfficeTypes']['BusinessRates']) ? $eachCenter['OfficeTypes']['BusinessRates'] : '',
								'ServiceCharge' => isset($eachCenter['OfficeTypes']['ServiceCharge']) ? $eachCenter['OfficeTypes']['ServiceCharge'] : '',
								'MinTerm' => isset($eachCenter['OfficeTypes']['MinTerm']) ? $eachCenter['OfficeTypes']['MinTerm'] : '',
								'MaxTerm' => isset($eachCenter['OfficeTypes']['MaxTerm']) ? $eachCenter['OfficeTypes']['MaxTerm'] : '',
								'MeasurementTypeID' => isset($eachCenter['OfficeTypes']['MeasurementTypeID']) ? $eachCenter['OfficeTypes']['MeasurementTypeID'] : '',
								'MeasurementType' => isset($eachCenter['OfficeTypes']['MeasurementType']) ? $eachCenter['OfficeTypes']['MeasurementType'] : '',
								'PriceDescription' => isset($eachCenter['OfficeTypes']['PriceDescription']) ? $eachCenter['OfficeTypes']['PriceDescription'] : '',
							);
						}
					}
					$officedata[] = $tempOfficeData;
				}

				// Get the photos data
				if (isset($eachCenter['Photos']['Photo']) && is_array($eachCenter['Photos']['Photo']) && count($eachCenter['Photos']['Photo'])) {
					foreach ($eachCenter['Photos']['Photo'] as $photoKey => $eachPhoto) {
						$tempPhotoData = array(
							'CentreID' => $eachCenter['CentreID'],
							'displayorder' => isset($eachPhoto['displayorder']) ? $eachPhoto['displayorder'] : '',
							'imagesizelabel' => isset($eachPhoto['imagesizelabel']) ? $eachPhoto['imagesizelabel'] : '',
							'imagewidth' => isset($eachPhoto['imagewidth']) ? $eachPhoto['imagewidth'] : '',
							'imageheight' => isset($eachPhoto['imageheight']) ? $eachPhoto['imageheight'] : '',
							'url' => isset($eachPhoto['url']) ? $eachPhoto['url'] : '',
						);
						$centrephotos[] = $tempPhotoData;
					}
				}

			}

			// echo '<pre>';
			// print_r($centredata);
			// print_r($officedata);
			// print_r($centrephotos);
			// die;

			$this->db->insert_batch('Centre', $centredata);
			$this->db->insert_batch('OfficeTypes', $officedata);
			$this->db->insert_batch('Photos', $centrephotos);
			// $error = $this->db->_error_message();
			$status = 1;
		}

		if (isset($error) && !empty($error)) {
			$status = 0;
		}
		return $status;
	}

	private function _test() {

		$one = array(
			'CentreID' => 222,
			'CentreChangeDate' => "2015-11-03T17:25:36.397",
			'OperatorCode' => "OM",
			'City' => "London",
			'CityDistrict' => "Islington",
			'Address' => "39 - 41 North Road,Islington,",
			'Postcode' => "N7 9DP",
			'CentreDescription' => "Flexible, modern space offered within Victorian premises, originally built as a horse-drawn-bus factory. The business centre provides both semi-serviced and conventional commercial style space. Unfurnished serviced office space from 100 sq ft up to 10,000 sq ft is offered on either short leases to suit individual client requirements with only a two-month termination period required. Services include: access to kitchen facilities; free membership to the City Car Club; opportunities for internal and external networking; regular, informal monthly tenant meetings with guest speakers; a fantastic communal lounge area with table tennis, table football, drinks and snacks; 'The Woodstore' bar, restaurant and lounge for client entertainment and events and large 'Al Fresco' communal spaces. Prices start from £290 per person, per month for shared space, and from £590 per month for a private office space.",
			'LocationDescription' => 'This centre is located between Caledonian Road and York Way, to the north of King\'s Cross station, and outside the Congestion Charge zone. The area is of mixed residential and commercial uses, with parks and public gardens within easy reach. Both underground and rail links are easily accessible, with Caledonian Road (Piccadilly Line) and Barnesbury stations within a few minutes\' walk.',
			'SearchResults' => 'North Road, Islington',
			'ShortFormCentreDescriptionEN' => 'Flexible, modern space within Victorian premises - Originally built as a horse-drawn-bus factory - Unfurnished serviced office space',
			'CentreDescriptionEN' => "Flexible, modern space offered within Victorian premises, originally built as a horse-drawn-bus factory. The business centre provides both semi-serviced and conventional commercial style space. Unfurnished serviced office space from 100 sq ft up to 10,000 sq ft is offered on either short leases to suit individual client requirements with only a two-month termination period required. Services include: access to kitchen facilities; free membership to the City Car Club; opportunities for internal and external networking; regular, informal monthly tenant meetings with guest speakers; a fantastic communal lounge area with table tennis, table football, drinks and snacks; 'The Woodstore' bar, restaurant and lounge for client entertainment and events and large 'Al Fresco' communal spaces. Prices start from £290 per person, per month for shared space, and from £590 per month for a private office space.",
			'Currency' => "GBP",
			'CostPerPerson' => 0,
			'MinSizeAvailable' => 1,
			'MaxSizeAvailable' => 100,
			'Totalworkstations' => 350,
			'NearestUnderground' => "Caledonian Road",
			'NearestTrainStation' => "Caledonian Road",
			'NearestRoadLink' => 'M1 jnct 1',
			'NearestAirport' => 'London City',
			'Country' => 'United Kingdom',
			'State' => 'London Greater',
			'Latitude' => 51.549,
			'Longitude' => -0.120678,
			'OfficeTypes' => array
			(
				array
				(
					'Type' => 'Serviced Offices',
					'TypeID' => 1,
					'OfficeTypeAssocID' => 169,
					'OfficeTypeChangeDate' => '2014-07-30T22:24:46.800',
					'TypePrice' => 0,
					'MinPrice' => 0,
					'MaxPrice' => 0,
					'MinSize' => 1,
					'MaxSize' => 100,
					'TotalSize' => 350,
					'AvailableSpace' => 0,
					'BusinessRates' => 0,
					'ServiceCharge' => 0,
					'MinTerm' => 0,
					'MaxTerm' => 0,
					'MeasurementTypeID' => 1,
					'MeasurementType' => 'Workstations',
					'PriceDescription' => 'Serviced offices from £POA per person per month',
				),

				array
				(
					'Type' => 'Leased Spaces',
					'TypeID' => 3,
					'OfficeTypeAssocID' => 13036,
					'OfficeTypeChangeDate' => '2014-07-30T22:24:46.800',
					'TypePrice' => 0,
					'MinPrice' => 0,
					'MaxPrice' => 0,
					'MinSize' => 100,
					'MaxSize' => 10000,
					'TotalSize' => 0,
					'AvailableSpace' => 0,
					'BusinessRates' => 0,
					'ServiceCharge' => 0,
					'MinTerm' => 0,
					'MaxTerm' => 0,
					'MeasurementTypeID' => 2,
					'MeasurementType' => 'Square Feet',
					'PriceDescription' => 'Leased spaces from £POA per sq. ft.',
				),

			),
			'Photos' => array
			(
				'Photo' => array
				(
					array
					(
						'displayorder' => 1,
						'imagesizelabel' => '320width',
						'imagewidth' => 320,
						'imageheight' => 484,
						'url' => 'http://content.instantoffices.com/Prod/images/centres/320width/222/222-34565.jpg',
					),

					array
					(
						'displayorder' => 1,
						'imagesizelabel' => '101width',
						'imagewidth' => 67,
						'imageheight' => 101,
						'url' => 'http://content.instantoffices.com/Prod/images/centres/extrasmall/222/222-34565.jpg',
					),

				),
			),
		);

		// print_r($one);die;

		return array(
			'Center' => array(
				$one,
			),
		);
	}

}
