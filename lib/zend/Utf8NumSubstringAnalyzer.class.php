<?php
/***
 * Author: Christoph Herbst 
 * Date: 07.2010
 *
 * This is a custom text analyser, which treats words with digits as
 * one term, analyses utf8 input and retrieves all substrings up to the last
 * 3-characters of a token
**/
 
class Utf8NumSubstringAnalyzer extends Zend_Search_Lucene_Analysis_Analyzer_Common_Utf8Num_CaseInsensitive
{

 /**
     * Current char position in an UTF-8 stream
     *
     * @var integer 
     */
    private $_position;
 
    /**
     * Current binary position in an UTF-8 stream
     *
     * @var integer 
     */
    private $_bytePosition;
 
    /**
     * Current start position for matched word
     *
     * @var integer 
     */
    private $_startPos;
 
    /**
     * Current start offset for matched word
     *
     * @var integer 
     */
    private $_startOffset;
   
   /**
     * Current matched word
     *
     * @var integer 
     */
    private $_matchedWord;

    /**
     * Reset token stream
     */
    public function reset()
    {
        $this->_position     = 0;
        $this->_bytePosition = 0;
        $this->_startPos     = 0;
        $this->_startOffset  = 0;
 
        // convert input into UTF-8
        if (strcasecmp($this->_encoding, 'utf8' ) != 0  &&
            strcasecmp($this->_encoding, 'utf-8') != 0 ) {
                $this->_input = iconv($this->_encoding, 'UTF-8', $this->_input);
                $this->_encoding = 'UTF-8';
        }
    }
 
    /**
     * Tokenization stream API
     * Get next token
     * Returns null at the end of stream
     *
     * @return Zend_Search_Lucene_Analysis_Token|null
     */
    public function nextToken()
    {
        if ($this->_input === null) {
            return null;
        }
 
        do {
	    if ( $this->_startOffset === 0 ) {
            	if (! preg_match('/[\p{L}\p{N}]+/u', $this->_input, $match, 
				 PREG_OFFSET_CAPTURE, $this->_bytePosition)) {
                	// It covers both cases a) there are no matches (preg_match(...) === 0)
                	// b) error occured (preg_match(...) === FALSE)
                	return null;
            	}
            	// matched string
            	$this->_matchedWord = $match[0][0];
 
            	// binary position of the matched word in the input stream
            	$binStartPos = $match[0][1];
 
            	// character position of the matched word in the input stream
            	$this->_startPos = $this->_position +
                        iconv_strlen(substr($this->_input,
                                            $this->_bytePosition,
                                            $binStartPos - $this->_bytePosition),
                                     'UTF-8');
            	// character postion of the end of matched word in the input stream
            	$endPos = $this->_startPos + iconv_strlen($this->_matchedWord, 'UTF-8');
 
            	$this->_bytePosition = $binStartPos + strlen($this->_matchedWord);
            	$this->_position     = $endPos;
 	    }

            $token = $this->normalize(new Zend_Search_Lucene_Analysis_Token(
		iconv_substr($this->_matchedWord,$this->_startOffset,
			     iconv_strlen($this->_matchedWord, 'UTF-8'),'UTF-8'), 
		$this->_startPos + $this->_startOffset, $this->_position));
	    if ( $this->_position - ($this->_startPos + $this->_startOffset) <= 3 )
		$this->_startOffset = 0;
	    else
		$this->_startOffset++;
        } while ($token === null); // try again if token is skipped
 
        return $token;
    }
}

