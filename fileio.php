<html>
<head>
<title> TEST </title>
</head>
<body>
<?php
$column_name="Datamining_project_report";
$stringput="Project Report: Data Mining (    )   Submitted:     
Document Clustering & Content Based Information Retrieval    Abstract This paper describes the development of a document retrieval system, which implements data pre processing steps like stemming and stop words, clusters the document set using an online clustering algorithm called Online Spherical K means algorithm and finally retrieves the documents based on query term frequency ranking  The necessity of pre processing and clustering of documents is studied and explained in the paper, and the information retrieval system is implemented with and without     INTRODUCTION Large document corpus may afford a lot of useful information to people  But it is also a challenge to find out the useful information from huge number of documents  It is almost impossible for anyone to read through all the documents and find out the relative for a specific topic and retrieving information from the document set should also satisfy two main properties– Speed and Accuracy  The speed and accuracy depend on the factors like “how efficiently the documents are sorted and stored, how accurately the search results are returned from the documents”  In this project we develop a search engine which achieves both speed and accuracy  For achieving these two properties, we sort the entire data set into group of document clusters and rank the resulted documents based on the term frequency for accuracy  Document clustering is an important technique for unsupervised document organization, and fast information retrieval  Document clustering assists in grouping documents that belong together and creates a link between the similar documents, which allows similar documents to be retrieved once one of the document matches with the query  We compare and find feasible clustering algorithms which may achieve good performance with highly efficiency when dealing with thousands of documents [ ]  We develop a search engine, and evaluate the effects of pre processing and clustering of documents, i e , we retrieve documents from the corpus with and without the pre processing and clustering methods and compare the performance  The rest of the paper is organized as Section   describes the problem definition describing the various obstacles we encounter while retrieving information from large document sets, Section   describes the various feature extraction steps that we implement to process the documents, Section   describes the clustering methods we implement to group the documents, Section   describes the working of the search engine, the effect of clustering and pre processing the text are demonstrated through experiments in Section  ,and propose the future work and conclude in Section       PROBLEM DEFINITION The document set we are using for information retrieval is geological data  The Department of Earth Sciences,   has been documenting all its field work from the past    years and the document corpus currently consists around       documents  The documents

 
will be added continuously into the corpus and are indexed according to the alphabetic order of the title  One has to either have domain knowledge or know the title he is searching for or has to traverse through the list to find the related title  There is no content based information retrieval system to retrieve the documents based on a query  The aim of this project is to develop an efficient and accurate search engine which retrieves the documents based on the similarity between the user query and the content of the documents  The main characteristic of a large document corpus is the huge volumes of the data, one cannot read through all the documents to find out the relative for a specific topic  Following are the characteristics of the chosen document corpus [ ]:
  Huge number of documents: The document corpus we are dealing with consists around       documents 
  High dimensionality: If unique term is considered as one dimension,      documents may contain more than       unique terms, therefore the term document matrix for the corpus will be a      *     matrix, which leads to computational and memory challenges while processing 
  Multiple forms of a term: Terms with multiple forms are very common in documents, a single word like information may have similar forms like informing, informative, inform etc  These forms increase the dimensions of the data 
  Noisy data: There may be many common language terms like „the ,  is ,  are  which cannot be used to uniquely identify a document and occur like many times in all the documents, such data can shift the uniform distribution of data in a document 
PROPOSED SOLUTION We propose to develop a search engine that divides the huge document corpus into multiple clusters of documents that contain similar data  By doing so, we can organize similar documents together which facilitates easy maintenance of the documents and also when a user queries, we can only look into a particular group of clusters and not the complete document corpus as the clusters are generated based on the similarity of terms which indicates similarity of content  The retrieved results might also be a huge dataset depending on the user query, so we also propose to develop a ranking based information retrieval system which ranks the retrieved document based on the mean value of TF IDF value of all the terms in the document that match with the user query  We present the results to the user in the decreased order of the rank generated  The process of retrieving information from the document sets includes the following steps:
   Feature Extraction
It includes pre processing the text, extracting the document features by weighing the terms in the document, generating a term frequency matrix 
   Document Clustering
It includes clustering similar documents into one cluster, the similarity measure is calculated from the term frequency matrix 
   Query Processing
Since we are pre processing the text before clustering the documents, the user query should also be pre processed before querying the respective clusters and retrieving information 
Document Clustering and Information Retrieval
 
   FEATURE EXTRACTION DATA PRE PROCESSING The data in the large document corpus is usually redundant and consists lot of noisy data  Preprocessing is a process to optimize the list of terms that identify the collection  The aim of preprocessing phase is to eliminate all the terms with no significant information that can affect the quality of clustering and also to decrease the size of the data dictionary  The following techniques are applied to pre process the data to eliminate the redundant and noisy data in our document set  A  STOP WORDS: Stop words are frequent words that carry no information and meaningless when used as search term  The main property of stop words is that they are extremely common words, the concept of the sentence is still held even after these words are removed  Removing these stop words could save huge amount of space, it also helps to deduce the noises and keep the core words that make the later processing easy and effective  Stop words are dependent on the language; different languages have different stop words  Basically there are three types of stops words: generic stop words, mis spelling stop words and domain stop words  Generic stop words can be picked up when reading the documents; the latter two have to need all the documents to be processed and also some domain knowledge [ ]  GENERIC STOP WORDS: These are non information bearing words in a language  The context of the summary still stays the same even after removing these words and no domain knowledge is required to remove these words  These words can be eliminated by using a list of stop words and programming the system to use this list as reference and remove any matching terms instead of putting into further processing  MIS SPELLING STOP WORDS: There might be words that are mis spelt in a document, these do not mean anything and also increase the dimension of the data, so these words can be considered as stop words and removed from the further processing  DOMAIN STOP WORDS: Domain stop words in general are not extremely common words but they turn into stop words only under specific domain knowledge or contents  In general words that occur in almost all the documents have no unique identity and are considered as Domain stop words and are removed because they are too common in the corpus, including them will not provide help to distinguish individual document  In this project, we only consider the Generic Stop words as stop words and do not deal with the other two kinds  The reason for this is we do not want to analyze all the documents to search for mis spelling words and we do not have any domain knowledge to remove the Domain Stop words and we also implement the Inverse Document frequency factor later while processing the documents so that the terms occurring very frequently have less term weightage  We maintain a list of generic stop words and compare each term in the document with this list and only process the words that do not match  B  STEMMING: Morphological variants of words usually have similar meanings  In English, nouns have singular and plural forms; verbs have present, past and past participle tenses  These different forms of the same word could be a problem for text data analysis because they have different spellings but share the similar meaning 

 
Taking these different forms of a same word into account may cost too much space and lose the connection between these words  And as a result it introduces noise and makes the later processing more difficult  Stemming is necessary before the documents are clustered  There are many ways to stem the data, we adopt the process of stemming the different variants of a word into a root by removing the affixes  In our project we use Porter Stemmer [ ] which is a widely applied method to stem documents  It is compact, simple and relatively accurate  We do over stem the data as it may cause negative effects by introducing noisy data  TERM WEIGHING: In vector space model a document is represented by a vector which contains the term weighting information for the document  Term weighing is based on the concept that terms occurring more frequently in a particular document and less frequently over all the documents in the corpus  Two factors that are used for weighing a term are a  TERM FREQUENCY: The number of times a term occurs in the document is called as the term frequency  We process each document and calculate the term frequency of all the terms in the document  b  INVERSE DOCUMENT FREQUENCY: A particular set of words which are not generic stop words may occur more frequently in all the documents in the set, thereby having a high term frequency for all the documents, these do not help in identifying the topic of the document, so in order to normalize the weight of all the terms, we include inverse document frequency which takes into account the frequency of a term over all the documents  The inverse document frequency is given by Idf(term,document)=log(Total number of documents  Number of documents in which the term occurs) c  TF IDF MATRIX We create a matrix called Term frequency  Inverse Document frequency which is obtained by the product of term frequency and inverse document frequency values  We use this TF IDF matrix values to calculate the similarity between documents and between the user query and the document set [  ]  Document Clustering and Information Retrieval
 
   DOCUMENT CLUSTERING Document clustering is a subset of the larger field of data clustering  Clustering involves dividing the data set into a specified number of clusters  After clustering a data set, the inherent structure in the data can be analyzed and can be divided into set of groups based on this structure and the similarity  Efficient clustering should be able to organize dataset into clusters of data such that objects within each cluster are similar to each other and dissimilar to those in other clusters  Unsupervised clustering algorithms have increasingly been used for their applicability to data mining concepts [ ]  Clustering techniques can be broadly classified into two techniques: “Partitioning” [ ] and “Hierarchical” [ ]  Although hierarchical clustering techniques emphasize on the clustering quality, the time complexity of these approaches is quadratic  In recent years, it has been recognized that the partitioning clustering techniques are well suited for clustering large document dataset due to their relatively low computational requirements [ ]  The time complexity of these techniques is almost linear, which makes it widely used  The best known partitioning clustering algorithm is the K means algorithm and its variants [ ]  In the K means algorithm, all the terms in the vector space model are represented in the vector space and similarity between documents is measured using the Euclidean distance between the points, spherical K means which is a variant of K means uses cosine similarity measure to calculate the similarity between two documents  If x and y are two document vectors, the cosine measure is defined as However, it has been mainly used in batch mode  That is, each cluster mean vector is updated, only after all document vectors being assigned, as the (normalized) average of all the document vectors assigned to that cluster  To overcome this, an online version of the spherical K means algorithm which is based on well known Winner Take All competitive learning has been developed  Online clustering algorithms perform document clustering when receiving the request and return the request within a limited period  In this algorithm, each center cluster is incrementally updated given a document [ ]  As documents are added to the clustering, clusters compete for the input and the cluster to which the document is added adjusts more strongly to future input according to a certain learning rate  Let d be a document in corpus D, the average cosine similarity objective function can be defined as Where k(d)=argmaxk denotes the respective cluster center of each d€D and dT µk(d) is the dot product of the document vector and this centroid  Rather than updating the cluster centroids by computing the mean, the online variant factors a learning rate   into the update function: The learning rare   controls how clusters “adjust” to future documents  Zhong [ ] describes an annealing learning rate (gradually decreasing) to work best 
 Where N is the number of the documents, M is the number of batch iterations, and  f the desired final learning rate ( f=     has been used)  The advantages of online clustering algorithm are Experimental results state that OSKM converges about twice as quickly as SKM algorithm, it can be appropriate for real time applications     IMPLEMENTATION The search engine is written in PHP using MySql database   The product facilitates multiple users to upload documents at the same time, the following sequence of operations happen when the document is uploaded, DOCUMENT INDEXING
  Term Pre processing
The text from the document is extracted and is breaked down into words, these words are compared with stop words and are processed by stemming algorithm and then only the useful words are used for further processing 
  Term Frequency calculation
The frequency of each word occurrence is calculated and all the terms with the respective frequency count are saved in the database with the respective document name 
  Creating TF IDF matrix
After the TF values are calculated, the respective IDF values for each term in a document are calculated and the TF IDF value of each term is saved  CLUSTERING Initially we have decided to partition the whole document set into   cluster groups, so with the help of domain expertise, we uploaded   documents of different classes into the   clusters and, for every new document uploaded, the cosine similarity is calculated with the existing mean value of the cluster and the document is assigned to the cluster with more similarity  After a document gets assigned to a cluster, the mean of the cluster is updated with respect to the new document  Rather than updating the cluster centroids by computing the mean, the online variant factors a learning rate   into the update function: For ease of operation, we maintain   mysql tables for the   cluster groups, the mean cosine value us stored in a data structure and every new document is compared with the three latest mean values  QUERY PROCESSING When a user queries for a particular document, the query string is divided into words and are subjected to stemming and are compared with the stop words, then a query vector is created with the same dimensions as of the document vector, bearing a value   at the respective position of term in the term matrix, all other values are set to zero  Then the similarity between the mean values of the three cluster heads and the query vector is calculated and the cluster with highest similarity is noted, then the similarity values of the query Document Clustering and Information Retrieval
 
vector and all the document vectors in that particular cluster is calculated, this can be easily done as we have stored documents of different clusters in different tables and to filter the results, we considered a threshold value as     only the documents with cosine similarity value greater than this threshold value are sorted in decreasing order of their similarity values and returned to the user in the same order  Thus by initially comparing the similarity values of query and the cluster heads, we choose to iterate calculating the similarity values only among the documents of a particular cluster thereby reducing the complexity by a huge factor, and inside the cluster, the documents are retrieved based on their relevance to the user query  Since the documents are all pre processed, indexed and clustered at the time of uploading the documents are retrieved effectively and accurately     EVALUATION We evaluate the information retrieval system based on the following factors:    STORAGE AND PROCESSING COMPLEXITY WITH AND WITHOUT DATA PRE PROCESSING: For evaluation purpose the documents related to the user query are retrieved with pre processing the documents and the query with stop words and stemming and then without pre processing the data  Although there are arguments that the concept of stemming and stop words is controversial as the meaning of the documents is altered eliminating some terms and stemming their forms, subjecting the documents to these processes reduces the computational complexity by a huge factor as the number of calculations like TF, IDF, TF IDF and similarity calculation requires iteration through all the terms for all the documents which is of high computational complexity  Comparing the results under the two cases, it was found that the result set for the user query is almost the same in both the cases but the time taken for the documents to be retrieved is very less when the documents and query are pre processed when compared to the system without data pre processing  As the number of terms is reduced, gain in storage can also be achieved  WITH AND WITHOUT CLUSTERING: Clustering reduces the computational factor by a huge factor, when a user query is processed first its similarity value to the cluster heads is calculated and then similar documents from the cluster whose cluster head is more similar to the user query are retrieved thereby reducing the processing of other two clusters  This is a huge computational gain     ONLINE CLUSTERING Online clustering algorithms perform document clustering when receiving the request and return the request within a limited period and thus the clustering result is up to date  Online clustering only updates the necessary documents in the corpus instead of re clustering all documents when new documents are added into the document corpus  Given an existing document corpus and the clustering result, when new documents are added into the document collection, online clustering algorithms only apply clustering calculation on the new inserted documents and a small part of the original document collection [  ]  Rather than updating the cluster centroids by computing the mean, the online variant factors a learning rate   into the update function [ ]: This results in relatively less calculation complexity and fast clustering speed when new documents are inserted into the document corpus and the cluster result is up to date     FUTURE WORK AND CONCLUSION In this project, we have developed a document retrieval system based on the concept of term frequency weightage, we have performed pre processing steps like stemming, usage of stop words to reduce the complexity of calculation and eliminate the noisy data, we have then clustered the documents using an online clustering algorithm called Online Spherical K means algorithm which uses co sine similarity measure and adapts an online learning rate to update the cluster heads rather than calculating the mean value  The user query is processed such that it only searches for documents in the related topic set or cluster, thereby making the document retrieval easy and effective  In this work, we have only considered the generic stop words, future works include considering mis spelling stop words and domain specific stop words that reduce the dimensions of the term matrix by a huge factor, thereby reducing the complexity of various calculations like TF, TDF, TF IDF and similarity calculations and clustering  The efficiency of any information retrieval system is calculated based on the recall and precision values [  ], due to the lack of domain expertise, these validation measures are not performed and will be done in the future work and the experimental results will be produced  References
[ ] Selim, Shokri Z , and Mostafa A  Ismail 
 K means type algorithms: a generalized convergence theorem and characterization of local optimality   Pattern Analysis and Machine Intelligence, IEEE Transactions on   (    ):       
[ ] Amala Bai, V M ; Manimegalai, D ;
 An analysis of document clustering algorithms,  Communication Control and Computing Technologies (ICCCCT),      IEEE International Conference on , vol , no , pp        ,     Oct       doi:         ICCCCT             
[ ] Ian H Witten, “Text Mining”,
University of Waikato, New Zealand 
[ ] Andrews, Nicholas O , and Edward A  Fox 
 Recent developments in document clustering   (    ) 
[ ] Berkhin, Pavel   A survey of clustering data mining techniques   Grouping multidimensional data (    ):       
[ ] Zhong, Shi   Efficient online spherical k means clustering   Neural Networks,       IJCNN     Proceedings       IEEE International Joint Conference on  Vol     IEEE,      
[ ] Loretta Auvil, Duane Searsmith  Using Text Mining for Spam Filtering  Supercomputing       
[ ] Marko Grobelnik, Dunja Mladenic and J  Stefan 
Text Mining Tutorial
Document Clustering and Information Retrieval
 
[ ] The Porter Stemming Algorithm  http:  www tartarus org  martin PorterStemmer 
[  ] Clara Yu, John Cuadrado, Maciej Ceglowski, J  Scott Payne 
Patterns in Unstructured Data: Discovery, Aggregation, and Visualization 
[  ] Vester, Kenneth Lolk, and Moses Claus Martiny 
Information retrieval in document spaces using clustering  Technical University of Denmark, Informatics and Mathematical Modelling,      
[  ] Salem, Sameh A , and Asoke K  Nandi   New assessment criteria for clustering algorithms   Machine Learning for Signal Processing,      IEEE Workshop on  IEEE,      ";
$host=""; // Host name
$username=""; // Mysql username
$password=""; // Mysql password
$db_name=""; // Database name
$tbl_name=""; // Table name
ini_set('max_execution_time',300);
include('stem_code.php');


$stringput=strtolower($stringput);
$allword_count=explode(" ",$stringput);

$wordarray=array();
$wordarrays=array();
foreach($allword_count as $key=>$val)
{
{
array_push($wordarrays,$val);
}
}



/*Stemming Code*/
foreach($wordarrays as $key=>$word)
{
$stem = PorterStemmer::Stem($word);
array_push($wordarray,$stem);
}
$stopwords=array('!','@','#','%','^','&','*','(',')','-','_','+','=','`','~','{','[',']','}',':',';','"',',','.','/','|','<','>','?',
'a',
'b',
'c',
'd',
'e',
'f',
'g',
'h',
'i',
'j',
'k',
'l',
'm',
'n',
'o',
'p',
'q',
'r',
's',
't',
'u',
'v',
'w',
'x',
'y',
'z',
'able',
'about',
'above',
'abroad',
'according',
'accordingly',
'across',
'actually',
'adj',
'after',
'afterwards',
'again',
'against',
'ago',
'ahead',
'all',
'allow',
'allows',
'almost',
'alone',
'along',
'alongside',
'already',
'also',
'although',
'always',
'am',
'amid',
'amidst',
'among',
'amongst',
'an',
'and',
'another',
'any',
'anybody',
'anyhow',
'anyone',
'anything',
'anyway',
'anyways',
'anywhere',
'apart',
'appear',
'appreciate',
'appropriate',
'are',
'around',
'as',
'aside',
'ask',
'asking',
'associated',
'at',
'available',
'away',
'awfully',
'back',
'backward',
'backwards',
'be',
'became',
'because',
'become',
'becomes',
'becoming',
'been',
'before',
'beforehand',
'begin',
'behind',
'being',
'believe',
'below',
'beside',
'besides',
'best',
'better',
'between',
'beyond',
'both',
'brief',
'but',
'by',
'came',
'can',
'cannot',
'cant',
'caption',
'cause',
'causes',
'certain',
'certainly',
'changes',
'clearly',
'co',
'co.',
'com',
'come',
'comes',
'concerning',
'consequently',
'consider',
'considering',
'contain',
'containing',
'contains',
'corresponding',
'could',
'course',
'currently',
'dare',
'definitely',
'described',
'despite',
'did',
'different',
'directly',
'do',
'does',
'doing',
'done',
'down',
'downwards',
'during',
'each',
'edu',
'eg',
'eight',
'eighty',
'either',
'else',
'elsewhere',
'end',
'ending',
'enough',
'entirely',
'especially',
'et',
'etc',
'even',
'ever',
'evermore',
'every',
'everybody',
'everyone',
'everything',
'everywhere',
'ex',
'exactly',
'example',
'except',
'fairly',
'far',
'farther',
'few',
'fewer',
'fifth',
'first',
'five',
'followed',
'following',
'follows',
'for',
'forever',
'former',
'formerly',
'forth',
'forward',
'found',
'four',
'from',
'further',
'furthermore',
'get',
'gets',
'getting',
'given',
'gives',
'go',
'goes',
'going',
'gone',
'got',
'gotten',
'greetings',
'had',
'half',
'happens',
'hardly',
'has',
'have',
'having',
'he',
'hello',
'help',
'hence',
'her',
'here',
'hereafter',
'hereby',
'herein',
'hereupon',
'hers',
'herself',
'hi',
'him',
'himself',
'his',
'hither',
'hopefully',
'how',
'howbeit',
'however',
'hundred',
'ie',
'if',
'ignored',
'immediate',
'in',
'inasmuch',
'inc',
'inc.',
'indeed',
'indicate',
'indicated',
'indicates',
'inner',
'inside',
'insofar',
'instead',
'into',
'inward',
'is',
'it',
'its',
'itself',
'just',
'k',
'keep',
'keeps',
'kept',
'know',
'known',
'knows',
'last',
'lately',
'later',
'latter',
'latterly',
'least',
'less',
'lest',
'let',
'like',
'liked',
'likely',
'likewise',
'little',
'look',
'looking',
'looks',
'low',
'lower',
'ltd',
'made',
'mainly',
'make',
'makes',
'many',
'may',
'maybe',
'me',
'mean',
'meantime',
'meanwhile',
'merely',
'might',
'mine',
'minus',
'miss',
'more',
'moreover',
'most',
'mostly',
'mr',
'mrs',
'much',
'must',
'my',
'myself',
'name',
'namely',
'nd',
'near',
'nearly',
'necessary',
'need',
'needs',
'neither',
'never',
'neverf',
'neverless',
'nevertheless',
'new',
'next',
'nine',
'ninety',
'no',
'nobody',
'non',
'none',
'nonetheless',
'noone',
'no-one',
'nor',
'normally',
'not',
'nothing',
'notwithstanding',
'novel',
'now',
'nowhere',
'obviously',
'of',
'off',
'often',
'oh',
'ok',
'okay',
'old',
'on',
'once',
'one',
'ones',
'only',
'onto',
'opposite',
'or',
'other',
'others',
'otherwise',
'ought',
'our',
'ours',
'ourselves',
'out',
'outside',
'over',
'overall',
'own',
'particular',
'particularly',
'past',
'per',
'perhaps',
'placed',
'please',
'plus',
'possible',
'presumably',
'probably',
'provided',
'provides',
'que',
'quite',
'qv',
'rather',
'rd',
're',
'really',
'reasonably',
'recent',
'recently',
'regarding',
'regardless',
'regards',
'relatively',
'respectively',
'right',
'round',
'said',
'same',
'saw',
'say',
'saying',
'says',
'second',
'secondly',
'see',
'seeing',
'seem',
'seemed',
'seeming',
'seems',
'seen',
'self',
'selves',
'sensible',
'sent',
'serious',
'seriously',
'seven',
'several',
'shall',
'she',
'should',
'since',
'six',
'so',
'some',
'somebody',
'someday',
'somehow',
'someone',
'something',
'sometime',
'sometimes',
'somewhat',
'somewhere',
'soon',
'sorry',
'specified',
'specify',
'specifying',
'still',
'sub',
'such',
'sup',
'sure',
'take',
'taken',
'taking',
'tell',
'tends',
'th',
'than',
'thank',
'thanks',
'thanx',
'that',
'thats',
'the',
'their',
'theirs',
'them',
'themselves',
'then',
'thence',
'there',
'thereafter',
'thereby',
'therefore',
'therein',
'theres',
'thereupon',
'these',
'they',
'thing',
'things',
'think',
'third',
'thirty',
'this',
'thorough',
'thoroughly',
'those',
'though',
'three',
'through',
'throughout',
'thru',
'thus',
'till',
'to',
'together',
'too',
'took',
'toward',
'towards',
'tried',
'tries',
'truly',
'try',
'trying',
'twice',
'two',
'un',
'under',
'underneath',
'undoing',
'unfortunately',
'unless',
'unlike',
'unlikely',
'until',
'unto',
'up',
'upon',
'upwards',
'us',
'use',
'used',
'useful',
'uses',
'using',
'usually',
'v',
'value',
'various',
'versus',
'very',
'via',
'viz',
'vs',
'want',
'wants',
'was',
'way',
'we',
'welcome',
'well',
'went',
'were',
'what',
'whatever',
'when',
'whence',
'whenever',
'where',
'whereafter',
'whereas',
'whereby',
'wherein',
'while',
'whereupon',
'wherever',
'whether',
'which',
'whichever',
'whilst',
'whither',
'who',
'whoever',
'whole',
'whom',
'whomever',
'whose',
'why',
'will',
'willing',
'wish',
'with',
'within',
'without',
'wonder',
'would',
'yes',
'yet',
'you',
'your',
'yours',
'yourself',
'yourselves',
'zero');

$useful_words=implode("=>",$wordarray);

$useful_words=str_replace("=>"," ",$useful_words);



$word_count=(array_count_values(str_word_count($useful_words,1)));
ksort($word_count);




$con=mysql_connect($host,$username,$password)or
die(mysql_error());
mysql_select_db($db_name,$con)or die(mysql_error());
{
$alter_sql="ALTER table $tbl_name ADD $column_name float";
mysql_query($alter_sql);

$select_sql="Select term from $tbl_name";
$select_result=mysql_query($select_sql);
$select_array=array();
while($row=mysql_fetch_array($select_result)) 
{
array_push($select_array,$row['term']);
}
foreach($word_count as $key=>$val)
{
if(in_array($key,$stopwords))
{
}
else
{
if(in_array($key,$select_array))
{

$update_sql="update $tbl_name set $column_name='$val' where term='$key'";
mysql_query($update_sql);

}
else
{

$insert_sql="Insert into $tbl_name (term) VALUES ('$key')";
$update_sql="update $tbl_name set $column_name='$val' where term='$key'";
mysql_query($insert_sql);

mysql_query($update_sql);

}
}
}
}
// making NULL as ZERO
$zero_query="update $tbl_name set $column_name=0 where $column_name is NULL";
mysql_query($zero_query);
//
mysql_close($con);
?>
</body>
</html>
