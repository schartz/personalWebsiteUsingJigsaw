---
extends: _layouts.post
section: content
title: X.509 Certificates Explained
date: 2019-07-06
description: This is your first blog post.
cover_image: /assets/img/posts/cert.svg
---

To put it simply, X.509 certificate is a digital document encoded and/or
digitally signed according to [RFC 5280](https://tools.ietf.org/html/rfc5280)

Generally speaking *X.509 certificate* refers to IETF's(Internet Engineering Task Force) PKIX certificate
 and CRL profile of the X.509 certificate v3 standard. Yes there are versions of this thing.
 This version is specified in [RFC 5280](https://tools.ietf.org/html/rfc5280). It is also known as PKIX, full form being "*Public Key Infrastructure (X.509)*"
 
 ### X509 File types
 There are a bunch of file type names being thrown around X.509. Occasionally and incorrectly it is said that they are all interchangeable. 
 While in come cases they may be interchangeable. It is always better to know your certificates and label them accordingly.  
 
 #### Encodings (may be used as file extensions on Windows systems)
 - .DER = The DER extension is used for binary DER encoded certificates. These files may also bear the CER or the CRT extension.
          It would be better to say that "**This is a DER encoded certificate**" rather than "This is DER certificate".
 - .PEM = The PEM extension is used for X.509v3 files which contain ASCII (Base64) encoded data prefixed with a "—–
   BEGIN ..." type of line.
   
 #### Common file extensions
 - CRT = The CRT extension is used for certificates. The certificates may be encoded as binary DER or as ASCII PEM. The CER and
   CRT extensions are nearly synonymous. Most common among *nix systems
   
 - CER = alternate form of .crt (Microsoft Convention) You can use MS to convert .crt to .cer (.both DER encoded .cer, or base64[PEM]
   encoded .cer) The .cer file extension is also recognized by IE as a command to run a MS cryptoAPI command (specifically
   rundll32.exe cryptext.dll,CryptExtOpenCER) which displays a dialogue for importing and/or viewing certificate contents.
 
 - .KEY = The KEY extension is used both for public and private PKCS#8 keys. The keys may be encoded as binary DER or as ASCII
   PEM.  
   
The only time CRT and CER can safely be interchanged is when the encoding type can be identical. (ie PEM encoded CRT = PEM encoded
CER)  

#### Basic OpenSSL Certificate Operations
There are four basic types of certificate manipulations. View, Transform, Combination , and Extraction

To view PEM encoded certificates

```bash
openssl x509 -in certfile -text noout
```

Here `certfile` can have any of the above mentioned encodings. Following error might occur:

```bash
unable to load certificate
12626:error:0906D06C:PEM routines:PEM_read_bio:no start line:pem_lib.c:647:Expecting: TRUSTED CERTIFICATE
```
This typically means that you are trying to read a certificate which is in DER format.  
To view a certificate use following
```bash
openssl x509 -in certfile -inform der -text -noout
```
You will encounter following error if you try to run above command on PEM encoded certificate:
```bash
unable to load certificate
13978:error:0D0680A8:asn1 encoding routines:ASN1_CHECK_TLEN:wrong tag:tasn_dec.c:1306:
13978:error:0D07803A:asn1 encoding routines:ASN1_ITEM_EX_D2I:nested asn1 error:tasn_dec.c:380:Type=X509
```

PEM to DER can be transformed like following
```bash
openssl x509 -in certfile -outform der -out cert.der
```

Similarly DER to PEM can be transformed like following
```bash
openssl x509 -in certfile -inform der -outform pem -out cert.pem
```

#### Combining X.509 certificate components
In some cases it is advantageous to combine multiple pieces of the X.509 infrastructure into a single file. One common example would be to
combine both the private key and public key into the same certificate.
The easiest way to combine certs keys and chains is to convert each to a PEM encoded certificate then simple copy the contents of each file
into a new file. This is suitable for combining files to use in a number of applications.  

Quite often you will come across a file with .p12 extensions.  
This type of file uses that uses PKCS#12 (Public Key Cryptography Standard #12) encryption.  
It is typically used as a portable format for transferring personal private keys or other sensitive information.  
It is also used by various security and encryption programs.

#### Extracting components from certificates
An X.509 certificate contains ONLY the public key and NEVER contains a private key.  
To extract the public key from it use following
```bash
openssl x509 -pubkey -noout -in certfile.pem
```

To calculate fingerprint/thumbprint/hash/signature of X.509 certificate in SHA256 use following
```
openssl x509 -noout -fingerprint -sha256 -inform pem -in certfile.pem
```

To calculate fingerprint/thumbprint/hash/signature of public key of X.509 certificate in SHA256 use following
```
openssl x509 -in certfile.pem -pubkey -noout | grep -v '^-' | base64 -d | openssl sha256
```
If you have your certificate in DER encoding, simple add `-inform der` to above commands accordingly.
