package com.plotbox.postcode.service;

import org.springframework.stereotype.Service;
import org.springframework.web.client.RestTemplate;

@Service
public class PostcodeService {

    private final RestTemplate restTemplate;

    public PostcodeService() {
        this.restTemplate = new RestTemplate();
    }

    public String searchPostcode(String postcode) {
        String url = "https://api.postcodes.io/postcodes/" + postcode;
        return restTemplate.getForObject(url, String.class);
    }
}
