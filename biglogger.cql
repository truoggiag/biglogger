CREATE TABLE biglogger.content (
    id uuid ,
    content text,
    id_app text,
    id_user int,
    iplog text,
    logtype text,
    tag text,
    timelog_client text,
    timelog_server text,
    PRIMARY KEY (id, timelog_client,timelog_server)
)   WITH CLUSTERING ORDER BY (timelog_client DESC);
CREATE CUSTOM INDEX fn_prefix1 ON biglogger.content (tag) USING 'org.apache.cassandra.index.sasi.SASIIndex' WITH OPTIONS = {'mode': 'CONTAINS', 'analyzer_class': 'org.apache.cassandra.index.sasi.analyzer.NonTokenizingAnalyzer', 'case_sensitive': 'false'};
CREATE CUSTOM INDEX fn_prefix2 ON biglogger.content (iplog) USING 'org.apache.cassandra.index.sasi.SASIIndex' WITH OPTIONS = {'mode': 'CONTAINS', 'analyzer_class': 'org.apache.cassandra.index.sasi.analyzer.NonTokenizingAnalyzer', 'case_sensitive': 'false'};
CREATE CUSTOM INDEX fn_prefix3 ON biglogger.content (logtype) USING 'org.apache.cassandra.index.sasi.SASIIndex' WITH OPTIONS = {'mode': 'CONTAINS', 'analyzer_class': 'org.apache.cassandra.index.sasi.analyzer.NonTokenizingAnalyzer', 'case_sensitive': 'false'};
CREATE CUSTOM INDEX fn_prefix4 ON biglogger.content (content) USING 'org.apache.cassandra.index.sasi.SASIIndex' WITH OPTIONS = {'mode': 'CONTAINS', 'analyzer_class': 'org.apache.cassandra.index.sasi.analyzer.NonTokenizingAnalyzer', 'case_sensitive': 'false'};


CREATE TABLE biglogger.visitor (
    id uuid,
    ngay_gio_vao text,
    browser text,
    he_dieu_hanh text,
    id_app text,
    ip_khach text,
    link_view text,
    location text,
    PRIMARY KEY (id, ngay_gio_vao)
) WITH CLUSTERING ORDER BY (ngay_gio_vao DESC);
CREATE CUSTOM INDEX fn_prefix5 ON biglogger.visitor (id_app) USING 'org.apache.cassandra.index.sasi.SASIIndex' WITH OPTIONS = {'mode': 'CONTAINS', 'analyzer_class': 'org.apache.cassandra.index.sasi.analyzer.NonTokenizingAnalyzer', 'case_sensitive': 'false'};
CREATE CUSTOM INDEX fn_prefix6 ON biglogger.visitor (link_view) USING 'org.apache.cassandra.index.sasi.SASIIndex' WITH OPTIONS = {'mode': 'CONTAINS', 'analyzer_class': 'org.apache.cassandra.index.sasi.analyzer.NonTokenizingAnalyzer', 'case_sensitive': 'false'};
CREATE CUSTOM INDEX fn_prefix7 ON biglogger.visitor (location) USING 'org.apache.cassandra.index.sasi.SASIIndex' WITH OPTIONS = {'mode': 'CONTAINS', 'analyzer_class': 'org.apache.cassandra.index.sasi.analyzer.NonTokenizingAnalyzer', 'case_sensitive': 'false'};
CREATE CUSTOM INDEX fn_prefix8 ON biglogger.visitor (he_dieu_hanh) USING 'org.apache.cassandra.index.sasi.SASIIndex' WITH OPTIONS = {'mode': 'CONTAINS', 'analyzer_class': 'org.apache.cassandra.index.sasi.analyzer.NonTokenizingAnalyzer', 'case_sensitive': 'false'};
CREATE CUSTOM INDEX fn_prefix9 ON biglogger.visitor (ip_khach) USING 'org.apache.cassandra.index.sasi.SASIIndex' WITH OPTIONS = {'mode': 'CONTAINS', 'analyzer_class': 'org.apache.cassandra.index.sasi.analyzer.NonTokenizingAnalyzer', 'case_sensitive': 'false'};
CREATE CUSTOM INDEX fn_prefix14 ON biglogger.visitor (browser) USING 'org.apache.cassandra.index.sasi.SASIIndex' WITH OPTIONS = {'mode': 'CONTAINS', 'analyzer_class': 'org.apache.cassandra.index.sasi.analyzer.NonTokenizingAnalyzer', 'case_sensitive': 'false'};

CREATE TABLE biglogger.app (
    dk_id_app uuid PRIMARY KEY,
    ten_app text,
    username text,
    website text
);
CREATE CUSTOM INDEX fn_prefix10 ON biglogger.app (ten_app) USING 'org.apache.cassandra.index.sasi.SASIIndex' WITH OPTIONS = {'mode': 'CONTAINS', 'analyzer_class': 'org.apache.cassandra.index.sasi.analyzer.NonTokenizingAnalyzer', 'case_sensitive': 'false'};
CREATE CUSTOM INDEX fn_prefix11 ON biglogger.app (username) USING 'org.apache.cassandra.index.sasi.SASIIndex' WITH OPTIONS = {'mode': 'CONTAINS', 'analyzer_class': 'org.apache.cassandra.index.sasi.analyzer.NonTokenizingAnalyzer', 'case_sensitive': 'false'};
CREATE CUSTOM INDEX fn_prefix12 ON biglogger.app (website) USING 'org.apache.cassandra.index.sasi.SASIIndex' WITH OPTIONS = {'mode': 'CONTAINS', 'analyzer_class': 'org.apache.cassandra.index.sasi.analyzer.NonTokenizingAnalyzer', 'case_sensitive': 'false'};


CREATE TABLE biglogger.log (
    id_app uuid PRIMARY KEY,
    tag text
);
CREATE CUSTOM INDEX fn_prefix13 ON biglogger.log (tag) USING 'org.apache.cassandra.index.sasi.SASIIndex' WITH OPTIONS = {'mode': 'CONTAINS', 'analyzer_class': 'org.apache.cassandra.index.sasi.analyzer.NonTokenizingAnalyzer', 'case_sensitive': 'false'};