<?php

/*
1. Parašykite funkciją, kuri pašalintų paskutinį žodį iš stringo
"A car is standing in a parkinglot." --> "A car is standing in a"
2. Parašykite funkciją, kuri patikrintų, ar tekstas atitinka lietuviško mobilaus telefono numerio formatą
"+37062345678" - true
"+37012345678" - false
"+3706234567" - false
"+3706234567a" - false
3. Patobulinkite funkciją (2). Funkcija turėtų galėti patikrinti ir tokius telefono numerius:
"+370 623 45678"
"+370-623-45678"
"+370-623 45678"
"00370 623 45678"
Jeigu telefono numeris validus, iš funkcijos turėtų grįžti tvarkingai suformatuotas telefono numeris:
"+370-623 45678" --> "+37062345678"
4. Parašykite funkciją, kuri užmaskuotų dalį vartotojo duomenų. Pavardės ir gimimo metų simboliai
turėtų būti pakeisti i simbolius 'X'.
"John Smith, 1979 05 15" --> "John XXXXX, XXXX 05 15"
5. Parašykite funkciją, kuri pravaliduotų IPv4 adresą. IPv4 adresas yra sudarytas iš 4 skaičių, kurių kiekvienas gali
būti nuo 0 iki 255. Skaičiai atskirti taškais.
Pvz.:
255.255.255.255
1.1.0.1
*/


//1. Parašykite funkciją, kuri pašalintų paskutinį žodį iš stringo

function removeLastWord($string): void
{
    echo preg_replace('/\W\w+\s*(\W*)$/', '$1', $string);
}
//removeLastWord('Hello world beee');

/**
 * 2. Parašykite funkciją, kuri patikrintų, ar tekstas atitinka
 * lietuviško mobilaus telefono numerio formatą
 *"+37062345678" - true
 *"+37012345678" - false
 *"+3706234567" - false
 *"+3706234567a" - false
 */
//^([+]|(00))370(-|\s|)6\d{2}(-|\s|)\d{5}
function phoneNumberValidation(array $phoneNumbers): array
{
    $validPhoneNumbers = [];
    foreach ($phoneNumbers as $phoneNumber) {
        if (preg_match('/^([+]|(00))3706\d{7}$/', $phoneNumber)) {
            $validPhoneNumbers[] = $phoneNumber;
        }
    }

    return $validPhoneNumbers;
}

//print_r(phoneNumberValidation(['+37062345678', '+37012345678', '+37062342578', '+3706234567', '+3706234567a']));

//3. Patobulinkite funkciją (2). Funkcija turėtų galėti patikrinti ir tokius telefono numerius:
//"+370 623 45678"
//"+370-623-45678"
//"+370-623 45678"
//"00370 623 45678"
//Jeigu telefono numeris validus, iš funkcijos turėtų grįžti tvarkingai suformatuotas telefono numeris:
//"+370-623 45678" --> "+37062345678"
function phoneNumberValidationV2(array $phoneNumbers): array
{
    $result = [];

    foreach ($phoneNumbers as $phoneNumber) {
        $result[] = str_replace([' ', '-'], '', $phoneNumber);
    }

    return phoneNumberValidation($result);
}

/*
 * 4. Parašykite funkciją, kuri užmaskuotų dalį vartotojo duomenų. Pavardės ir gimimo metų simboliai
 *turėtų būti pakeisti i simbolius 'X'.
 *"John Doe Smith, 1979 05 15" --> "John XXXXX, XXXX 05 15"
 */

function hideUserInfo(string $userInfo): string
{
    $userInfoArray = explode(' ', $userInfo);

    foreach ($userInfoArray as $key => $userInfoValue) {
        if (strpos($userInfoValue, ',')) {
            $userInfoArray[$key] = preg_replace('/[a-zA-Z]/', 'X', $userInfoValue);
        }

        if (is_numeric($userInfoValue) && strlen($userInfoValue) === 4) {
            $userInfoArray[$key] = preg_replace('/[0-9]/', 'X', $userInfoValue);
        }
    }

    return implode(' ', $userInfoArray);
}


function hideUserInfoV2(string $userInfo): string
{
    $userInfoArray = explode(' ', $userInfo);

    foreach ($userInfoArray as $key => $userInfoValue) {
        if (strpos($userInfoValue, ',')) {
            $userInfoValue = preg_replace('/[a-zA-Z]/', 'X', $userInfoValue); //XXXX,
        }

        $userInfoArray[$key] = preg_replace('/[0-9]{4}/', 'XXXX', $userInfoValue);
    }

    return implode(' ', $userInfoArray);
}

echo hideUserInfo("John Doe Smith, 1979 05 15");